<!DOCTYPE html>
<html>
<head>
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
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
            or die ("Errorea DB-ra konektatzean");
            
            $eposta = trim($_POST['eposta']);
            $pasahitza = trim($_POST['pasahitza']);
            
            if ($eposta === "" || $pasahitza === "") {
                die ("Bete beharrezkoak (*) diren eremu guztiak");
            }

            $emaitza = mysqli_query($esteka, "SELECT eposta FROM Users WHERE Users.eposta = '{$eposta}'");
            if(!$emaitza){
                die("Erabiltzaile okerra");
            }

            mysqli_free_result($emaitza);

            $emaitza = mysqli_query($esteka, "SELECT pasahitza FROM Users WHERE Users.eposta = '{$eposta}'");

            $strEmaitza = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)['pasahitza'];

            if ($strEmaitza != $pasahitza){
                die("Errorea kautotzean");
            }

            mysqli_free_result($emaitza);
            mysqli_close($esteka);
            
            header("Location: Layout.php?eposta=".$eposta);
            
        }
    ?>


  </section>
  <?php include '../html/Footer.html'?>
</body>
</html>
