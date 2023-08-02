<?php

// Get Parameter KOTA
if (isset($_GET['kota'])) {
    $parameter = $_GET['kota'];
}

// Get Database TXT
$data = file_get_contents("database.txt");
$rows = explode("\n", $data);
$rows = array_map("trim", $rows);
$rowCount = count($rows);

function CountCol($data){
	$col = explode("|", $data);
	return count($col);
}
  
 for ($i=2; $i <$rowCount-1 ; $i++) { 
 	 for ($j=0; $j < CountCol($rows[$i]) ; $j++) { 
 	 	 $column = explode("|", $rows[$i]);
 		 $id[$i-2]  = $column[0];
 		 $kota[$i-2]  = $column[1];
 		 $gmt[$i-2]  = $column[2]; 
 		 $long[$i-2]  = $column[3];
 		 $lat[$i-2]  = $column[4];
 	 }
 }

 for ($i=0; $i < $rowCount-3  ; $i++) { 
          $id[$i];
       	  $kota[$i];
       	  $gmt[$i];
       	  $long[$i];
          $lat[$i];    
 }

          $idku = $parameter;
          $ik = $idku - 1;
          $city = $kota[$ik];
          $longitudes = (float) $long[$ik];
          $latitudes = (float) $lat[$ik];
          $gmts = (float) $gmt[$ik];
          
    
// Get JADWAL SHOLAT by PARAMETER

        function jam($nilai){
            $value = 60 * 60 * $nilai;
            return $value;
        }

        function koreksi($nilai, $koreksi){
            $col = '+' . $nilai . ' minutes';
            $ret = strtotime("$col", strtotime($koreksi));
            return $ret;
        }
        
        extract($_GET, EXTR_PREFIX_ALL, 'p');
        extract($_POST, EXTR_PREFIX_ALL, 'p');
    
        include('PrayTime.php');
        date_default_timezone_set('Asia/Jakarta');
        $tempat = $city;
        $long = $longitudes;
        $lat = $latitudes;
        $timezone = $gmts;
        $method = 5;
        $correcting = 2;
        $prayTime = new PrayTime($method);
    
        // Times Now
        if ($timezone==7){
            $wi = "WIB";
            $now = strtotime(date('Y-m-d H:i:s'));
        }else if($timezone==8){
            $wi = "WITA";
            $timejon = time() + (60 * 60 * 8);
            $id = gmdate('d-m-Y H:i:s', $timejon);
            $now = strtotime($id);
        }else if($timezone==9){
            $wi = "WIT";
            $timejon = time() + (60 * 60 * 9);
            $id = gmdate('d-m-Y H:i:s', $timejon);
            $now = strtotime($id);
        }else{
            $wi = " ";
        }
        
        
        $times = $prayTime->getPrayerTimes($now, $lat, $long, $timezone);
        // End Times Now
    
        // Times After
        $afterdate = new DateTime();
        $afterdate->modify('+1 day');
        $after = strtotime($afterdate->format('Y-m-d H:i:s'));     
        $timesafter = $prayTime->getPrayerTimes($after, $lat, $long, $timezone);
        // End Times After
    
        // Display Sholat Clock
        $subuhbesok = koreksi($correcting, $timesafter[0]);
        $subuh = koreksi($correcting, $times[0]);
        $syuruq = koreksi($correcting,$times[1]);
        $dzuhur = koreksi($correcting,$times[2]);
        $ashar = koreksi($correcting,$times[3]);
        $maghrib = koreksi($correcting,$times[4]);
        $isya = koreksi($correcting,$times[6]);

        // End Clock

        // Output
        if($now < $syuruq - jam(1/2)){
            echo $tempat.' - Subuh '.date('H:i', $subuh).' '.$wi; 
        }else if($now > $syuruq - jam(1/2) && $now < $syuruq + jam(2)){
            echo $tempat.' - Syuruq '.date('H:i', $syuruq).' '.$wi;   
        }else if($now > $syuruq + jam(2) && $now < $ashar - jam(2)){
            echo $tempat.' - Dzuhur '.date('H:i', $dzuhur).' '.$wi;  
        }else if($now > $ashar - jam(2) && $now < $maghrib - jam(1)){
            echo $tempat.' - Ashar '.date('H:i', $ashar).' '.$wi;  
        }else if($now > $maghrib - jam(1) && $now < $isya - jam(1)){
            echo $tempat.' - Maghrib '.date('H:i', $maghrib).' '.$wi;  
        }else if($now > $isya - jam(1) && $now < $isya + jam(2)){
            echo $tempat.' - Isya '.date('H:i', $isya).' '.$wi;  
        }else if($now > $isya){
            echo $tempat.' - Subuh Besok '.date('H:i', $subuhbesok).' '.$wi;  
        }else{
            echo "";   
        }

?>