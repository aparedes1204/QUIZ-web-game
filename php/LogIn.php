<!DOCTYPE html>
<html>
<head>
    <?php
        if (!isset($_SESSION)){
            session_start();
        }
        if (isset($_SESSION["eposta"])){
            header("Location: Layout.php");
        }
    ?>
  <?php include '../html/Head.html'?>

  
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div id = "log-in" name = "log-in">
        <h1>Kautotzea</h1>

        <form id = "log-in-form" name = "log-in-form" method = "post" action="LogIn.php">
            <p>Eposta (*):<input type="text" id="eposta" name="eposta"><p>
            <p>Pasahitza (*):<input type="password" id="pasahitza" name="pasahitza"><p>
            <input type="button" id="hustu" name="hustu" value="Hustu" onclick="reset()">
            <input type="submit" id="submit" name="submit" value="Kautotu">
        </form>

        <button id="ghLogin" onclick = "document.location.href='../php/github_login.php'">Github-ekin kautotu</button>
    </div>

    <?php

        if($_SERVER['REQUEST_METHOD']=="POST") {
            include "DbConfig.php";
            try {
                $dsn = "mysql:host=$zerbitzaria;dbname=$db";
                $dbh = new PDO($dsn, $erabiltzailea, $gakoa);
              } catch (PDOException $e){
                $e->getMessage();
              }
            //$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die ("Errorea DB-ra konektatzean");
            
            $eposta = trim($_POST['eposta']);
            $pasahitza = trim($_POST['pasahitza']);
            
            if ($eposta === "" || $pasahitza === "") {
                die ("Bete beharrezkoak (*) diren eremu guztiak");
            }
            $stmt = $dbh->prepare("SELECT eposta FROM Users WHERE Users.eposta = ?");
            $stmt->bindParam(1, $eposta);
            $stmt->execute();
            // $emaitza = mysqli_query($esteka, "SELECT eposta FROM Users WHERE Users.eposta = '{$eposta}'");
            if($stmt -> rowCount() == 0){
                die("Erabiltzaile okerra");
            }

            //mysqli_free_result($emaitza);

            $stmt = $dbh->prepare("SELECT pasahitza FROM Users WHERE Users.eposta = ?");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $eposta);
            $stmt->execute();
            //$emaitza = mysqli_query($esteka, "SELECT pasahitza FROM Users WHERE Users.eposta = '{$eposta}'");

            // $strEmaitza = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)['pasahitza'];
            $strEmaitza = $stmt->fetch()['pasahitza'];
            if (!hash_equals($strEmaitza, crypt($pasahitza, $strEmaitza))){
                die("Errorea kautotzean");
            }

           // $emaitza = mysqli_query($esteka, "SELECT egoera FROM Users WHERE Users.eposta = '{$eposta}'");
            $stmt = $dbh->prepare("SELECT egoera FROM Users WHERE Users.eposta = ?");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $eposta);
            $stmt->execute();
            $strEmaitza = $stmt->fetch()['egoera'];
            // $strEmaitza = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)['egoera'];
            if($strEmaitza === "2"){
                die("Erabiltzaile blokeatuta. Ezin zara webgunera sartu.");
            }

            $stmt = $dbh->prepare("SELECT erMota FROM Users WHERE Users.eposta = ?");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $eposta);
            $stmt->execute();
            $erMota = $stmt->fetch()['erMota'];
            //mysqli_free_result($emaitza);

            //$emaitza = mysqli_query($esteka, "SELECT erMota FROM Users WHERE Users.eposta = '{$eposta}'");

            //$erMota = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)['erMota'];

            //mysqli_free_result($emaitza);
            //mysqli_close($esteka);
            
            include "IncreaseGlobalCounter.php";
            if (!isset($_SESSION)){
                session_start();
            }
            $_SESSION['eposta'] = $eposta;
            $_SESSION['erMota'] = $erMota;
            $dbh = null;
            if($erMota === "ikaslea"){
                header("Location: HandlingQuizesAjax.php");
            } 
            
            if ($erMota === "irakaslea"){
                header("Location: Layout.php");
            }

            if ($erMota === "admin"){
                header("Location: HandlingAccounts.php");
            }
            
        } else {
            if (isset($_GET['code'])){
                $code = $_GET['code'];


                $curl = curl_init();
                $url = 'https://github.com/login/oauth/access_token';
                $data=array('client_id' => '0a7982ebd304ebdff71f',
                            'redirect_uri' => 'https://sw.ikasten.io/~aparedes009/WS/php/LogIn.php',
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
        }
    ?>


  </section>
  <?php include '../html/Footer.html'?>
</body>
</html>
