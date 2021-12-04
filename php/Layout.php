<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main"id="s1">
      <h2>Top 10 quizers - Global ranking</h2>
      <br>
      <?php
        $curl = curl_init();
            $url = 'https://sw.ikasten.io/~aparedes009/rest/VipUsers?rank=10';
            //$url = "localhost/WS/rest/VipUsers?rank=10";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            $str = curl_exec($curl);
            echo $str;
      ?>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
