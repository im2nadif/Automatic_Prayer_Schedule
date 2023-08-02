
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="assets/breakingNews.css"/>
<script src="assets/jQuery.js"></script>
<script src="assets/breakingNews.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

.nav-text {
    vertical-align:middle;
}

.fa-facebook {
  
  color: white;
}

.fa-twitter {
 
  color: white;
}

.fa-youtube {
 
  color: white;
}

.fa-instagram {
 
  color: white;
}

</style>

<?php
$max = 39;
?>

<?php  
for ($x=1; $x<=$max; $x++) {
    echo '<script>
          var refreshId = setInterval(function(){
            $('.'\''.'#kota'.$x.'\''.').load('.'\''.'get.php?kota='.$x.'\''.');'.'
          }, 5000);
          </script>';
    }
?>  

<style>body{font-family:'Arial'; font-size:16px; background-color:#009933;}</style>
<body>
<div style="width:100%; max-width:960px; margin:0 auto; padding:0 20px 50px 20px; box-sizing:border-box;">
<br><br>
    <div class="breakingNews" id="bn3" id="">
       <ul>      
       <li><i class="fa fa-globe"></i>&nbsp;&nbsp;<span class="nav-text">https://www.madanitv.net</span></li>
        <li><i class="fa fa-instagram"></i>&nbsp;&nbsp;<span class="nav-text">Instagram - @Madani_TV</span></li>
        <li><i class="fa fa-facebook-square"></i>&nbsp;&nbsp;<span class="nav-text">Facebook - Madani TV</span></li>
        <li><i class="fa fa-youtube-play"></i>&nbsp;&nbsp;<span class="nav-text">Youtube - Madani TV</span></li>
        <li><i class="fa fa-twitter"></i>&nbsp;&nbsp;<span class="nav-text">Twitter - @MadaniTV_net</span></li>

       <?php  
          for ($x =1; $x<=$max; $x++) {
            echo '<li><span id='.'"kota'.$x.'"'.'></span></li>';
          }
        ?>  
    
       </ul>
    </div>
<script>
	$(window).load(function(e) {		
		$("#bn3").breakingNews({
			effect		:"slide-h",
			autoplay	:true,
			timer		  :5000,
			color		  :"turquoise",
			border		:true
		});
  });
 </script>
</body>
</html>
