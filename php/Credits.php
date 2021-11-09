<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script language="JavaScript" src="../js/GeoPlugin.js" type="text/javascript"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
	  	<div style="width:1050px; margin:0 auto;">
		
			<div style="padding:20px;float:left">
				<h1>	Iñaki Moreno </h1>
				<p>	Software Ingeniaritza </p>
				<p>	Urnieta </p>
				<img src="../images/adarra.jpg" width="250" height="200">
			</div>
			<div style="padding:20px;float:left">
				<h1>	Aitor Paredes </h1>
				<p>	Software Ingeniaritza </p>
				<p>	Donostia </p>
				<img src="../images/Kursaal.jpg" width="250" height="200">
    		</div>
		</div>
		<p>Bisitariaren informazioa:</p>
		<p id="visitorCity" name="visitorCity"></p>
		<p id="visitorLat" name="visitorLat"></p>
		<p id="visitorLong" name="visitorLong"></p>
		<br/>
		<p> Zerbitzariaren informazioa:</p>
		<?php
		$data = file_get_contents("https://api.freegeoip.app/json/?apikey=c656e670-4196-11ec-9bff-c741f5d19ced");
		$data = json_decode($data);
		echo "Zerbitzaria ".$data->country_name."-n dago<br/>";
		echo "Latitudea: ".$data->latitude."<br/>";
		echo "Longitudea: ".$data->longitude."<br/>";
		?>

  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
