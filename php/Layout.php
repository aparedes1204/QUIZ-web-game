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
      if (isset($_GET['code'])){
        $code = $_GET['code'];


        $curl = curl_init();
        $url = 'https://github.com/login/oauth/access_token';
        $data=array('client_id' => '0a7982ebd304ebdff71f',
                    'redirect_uri' => 'https://sw.ikasten.io/~aparedes009/WS/php/Layout.php',
                    'client_secret' => 'eb83de4d6bdd23abddc22f4e9b7423181e3da2be',
                    'code' => $code
                    );
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
            ));
        $json = curl_exec($curl);
        $response = json_decode($json, true);
        $access_token = $response['access_token'];
        echo($access_token);
        $url = "https://api.github.com/user/emails?access_token=$access_token";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization: token $access_token",
            "Accept: application/vnd.github.v3+json",
            "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
            ));
        $r = curl_exec($curl);
        var_dump($r);
        $emails = json_decode($r , true);
        //echo($emails[0]['email']);
        include "IncreaseGlobalCounter.php";
        if (!isset($_SESSION)){
            session_start();
        }
        $_SESSION['eposta'] = $emails[0]['email'];
        $_SESSION['erMota'] = 'ikaslea';
        header("Location: HandlingQuizesAjax.php");
      }
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
