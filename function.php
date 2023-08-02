<?php

class sholat{

    public $dzuhur;
    public $koreksi = 4;
    public $HAShubuh, $HAIsya, $HAMaghrib, $HAAshar, $HASyuruq;
   
    function cariwaktu($tanggal, $bulan, $tahun ,$timezone, $longitude,$latitude){
   
	$A = ($tahun)/100;
    $Bb = 2 + ($A/4) - $A;
    if($bulan <= 2){ $bulan = $bulan + 12; $tahun = $tahun - 1; }
    $jd_ut = round(1720994.5 + (365.25 * $tahun) + 30.6001 * ($bulan + 1) + $Bb + $tanggal);
  	$jd_lt = $jd_ut - ($timezone / 24);
    
    $U = ($jd_lt - 2451545) / 36526;
    $L = deg2rad(280.46607 + 36000.7698 * $U);
    $ET = (-1 * (1789 + 237 * $U) * sin($L) - (7146 - 62 * $U) * cos($L) + (9934 - 14 * $U) * sin(2 * $L)  - (29 + 5 * $U) * cos(2 * $L) + (74 + 10 * $U) * sin(3 * $L) + (320 - 4 * $U) * cos(3 * $L) - 212 * sin(4 * $L)) / 1000;

     $PI = 3.14159265359;
     $sudut_T = 2 * $PI * ($jd_lt - 2451545) / 365.25;
	 $radLatitude = deg2rad($latitude);   
     $deklinasi = deg2rad(0.37877 + 23.264 * sin((57.297 * $sudut_T - 79.547) * $PI/180) + 0.3812 * sin((2 * 57.297 * $sudut_T - 82.682) * $PI/180) + 0.17132 * sin((3 * 57.297 * $sudut_T - 59.722) * $PI/180));  
     
     $radSudutShubuh = deg2rad(-20);
     $this->HAShubuh = rad2deg(acos((sin($radSudutShubuh) - sin($deklinasi) * sin($radLatitude)) / (cos($deklinasi) * cos($radLatitude))));

     $radSudutSyuruq = deg2rad(-1);
     $this->HASyuruq = rad2deg(acos((sin($radSudutSyuruq) - sin($deklinasi) * sin($radLatitude)) / (cos($deklinasi) * cos($radLatitude))));

     $radSudutIsya = deg2rad(-18);
     $this->HAIsya = rad2deg(acos((sin($radSudutIsya) - sin($deklinasi) * sin($radLatitude)) / (cos($deklinasi) * cos($radLatitude))));

     $radSudutMaghrib = deg2rad(0.833 - 0.0347 * sqrt(8));
     $this->HAMaghrib = rad2deg(acos(sin($radSudutMaghrib) - sin($deklinasi) * sin($latitude)) / (cos($deklinasi) * cos($latitude)));

     $radSudutAshar = atan(1/(1 + tan((abs($radLatitude - $deklinasi)))));
     $this->HAAshar = rad2deg(acos((sin($radSudutAshar) - sin($deklinasi) * sin($radLatitude)) / (cos($deklinasi) * cos($radLatitude))));

     $this->dzuhur = 12 + $timezone - $longitude/15 - $ET/60;
    }

	function dzuhur(){
     $chours = str_pad(floor($this->dzuhur), 2, '0', STR_PAD_LEFT);
     $cminutes = str_pad(floor(($this->dzuhur - $chours) * 60 + $this->koreksi), 2, '0', STR_PAD_LEFT);
     return $display = $chours.":".$cminutes;
     //--------
 	}

    function syuruq(){
     $syuruq = $this->dzuhur - ($this->HASyuruq/15);
     $chours = str_pad(floor(floor($syuruq)), 2, '0', STR_PAD_LEFT);
     $cminutes = str_pad(floor(($syuruq - $chours) * 60), 2, '0', STR_PAD_LEFT);
     return $chours.":".$cminutes;
     //--------
    }

    function subuh(){
    //-----------
     $shubuh = $this->dzuhur - ($this->HAShubuh/15);
     $chours = str_pad(floor(floor($shubuh)), 2, '0', STR_PAD_LEFT);
     $cminutes = str_pad(floor(($shubuh - $chours) * 60 + $this->koreksi), 2, '0', STR_PAD_LEFT);
     return $chours.":".$cminutes;
     //-----------
    }

    function isya(){
     //-----------
    
     $isya = $this->dzuhur + ($this->HAIsya/15);
     $chours = str_pad(floor($isya), 2, '0', STR_PAD_LEFT);
     $cminutes = str_pad(floor(($isya - $chours) * 60 + $this->koreksi), 2, '0', STR_PAD_LEFT);
     return $display = $chours.":".$cminutes;
     //-----------
    }

    function maghrib(){
	 //-----------
    
	 $maghrib = $this->dzuhur + ($this->HAMaghrib/15);
	 $chours = str_pad(floor($maghrib), 2, '0', STR_PAD_LEFT);
     $cminutes = str_pad(floor(($maghrib - $chours) * 60 + $this->koreksi + 2), 2, '0', STR_PAD_LEFT);
     return $display = $chours.":".$cminutes;
     //-----------
	}

	function ashar(){
     //-----------
	
     $ashar = $this->dzuhur + ($this->HAAshar/15);
     $chours = str_pad(floor($ashar), 2, '0', STR_PAD_LEFT);
     $cminutes = str_pad(floor(($ashar - $chours) * 60 + $this->koreksi), 2, '0', STR_PAD_LEFT);
     return $display = $chours.":".$cminutes;
     //-----------
	}
}


	










