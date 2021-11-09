<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestionJS.js"></script>-->
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	  <h1>
      VIP erabiltzaile zerrendari eposta bat gehiago gehitzeko REST bezeroa:
    </h1>
		<form id="galderenF" method="post" name="vipGehitu" action=<?php echo "AddVip.php?eposta=".$_GET['eposta'] ?>>
	
			<p>Eposta(*): <input type="text" id="eposta" name="eposta" size="40"></p>
			<input	type="submit" id="submit" name="submit" value="Bidali">
			<input 	type="button" id="hustu" name="hustu" value="Hustu" onclick='this.reset()'>

		</form>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $curl = curl_init();
      $domain = $_SERVER['HTTP_HOST'];
      $path = $_SERVER['REQUEST_URI'];
      $relative = '/VipUsers/';
      $url = 'https://'.dirname($domain.$path).$relative;
      //$url = "localhost/WS/php/VipUsers/";
      $data=array('eposta' => $_POST['eposta']);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      $str = curl_exec($curl);
      echo $str;
    }
    ?>
    </div>
  </section>

  <?php include '../html/Footer.html' ?>
</body>
</html>
