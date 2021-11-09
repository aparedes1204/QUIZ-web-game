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
      Uneko VIP erabiltzaileak zerrendatzeko REST bezeroa:
    </h1>
<?php

    $curl = curl_init();
    $curl = curl_init();
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['REQUEST_URI'];
    $relative = '/VipUsers/';
    $url = 'https://'.dirname($domain.$path).$relative;
    //$url = "localhost/WS/php/VipUsers";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    $str = curl_exec($curl);
    echo $str;
?>
</div>
  </section>

  <?php include '../html/Footer.html' ?>
</body>
</html>
