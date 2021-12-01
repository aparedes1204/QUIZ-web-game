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
            
        }
    ?>


  </section>
  <?php include '../html/Footer.html'?>
</body>
</html>
