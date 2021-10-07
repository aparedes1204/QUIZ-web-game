<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div id = "sign-up" name = "sign-up">
        <h1>Erregistroa</h1>

        <form id = "sign-up-form" name = "sign-up-form" method = "post" action="SignUp.php">
            <p>Erabiltzaile mota (*):<input type="text" id="erMota" name="erMota"><p>
            <p>Eposta (*):<input type="text" id="eposta" name="eposta"><p>
            <p>Deitura (*):<input type="text" id="deitura" name="deitura"><p>
            <p>Pasahitza (*):<input type="password" id="pasahitza" name="pasahitza"><p>
            <p>Pasahitza errepikatu (*):<input type="password" id="pasahitzaErrep" name="pasahitzaErrep"><p>
            <input type="button" id="hustu" name="hustu" value="Hustu" onclick="reset()">
            <input type="submit" id="submit" name="submit" value="Bidali">
        </form>


    </div>

    <?php

        if($_SERVER['REQUEST_METHOD']=="POST") {
            include "DbConfig.php";
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
            or die ("Errorea DB-ra konektatzean");
            
            $erMota = trim($_POST['erMota']);
            $eposta = trim($_POST['eposta']);
            $deitura = $_POST['deitura'];
            $deitura = trim(preg_replace("/\s+/",' ',$_POST['deitura']));
            $pasahitza = $_POST['pasahitza'];
            $pasahitzaErrep = $_POST['pasahitzaErrep'];
            
            if ($erMota === "" || $eposta ==="" || $deitura === "" || $pasahitza === "" || $pasahitzaErrep === "") {
                die ("Bete beharrezkoak (*) diren eremu guztiak");
            }
            
            
            if (!filter_var($erMota,
                FILTER_VALIDATE_REGEXP, 
                array('options' => array('regexp' => '/^(irakaslea|ikaslea)$/')) )
                ) {
                die('Erabiltzaile mota okerra (ikaslea edo irakaslea)');
            }

            if (!filter_var($eposta,
            FILTER_VALIDATE_REGEXP, 
            array('options' => array('regexp' => '/^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/')) )
            ) {
              die('Eposta okerra. EHUko ikasle edo irakasle batena izan behar da');
            }

            if (!filter_var($deitura,
            FILTER_VALIDATE_REGEXP, 
            array('options' => array('regexp' => '/^[a-zA-Z]{2,}\s[a-zA-Z]{2,}\s?([a-zA-Z]{2,}\s?)*$/')) )
            ) {
              die('Deitura okerra. Zure Izena eta abizena jarri mesedez');
            }

            if (!filter_var($pasahitza,
            FILTER_VALIDATE_REGEXP, 
            array('options' => array('regexp' => '/^(\S){8,}$/')) )
            ) {
              die('Pasahitz okerra. Gutxienez 8 karakterekoa izan behar da, hutsunerik gabe');
            }

            if($pasahitza!==$pasahitzaErrep){
                die('Pasahitzak ez dira berdinak');
            }

            $emaitza = mysqli_query($esteka, "SELECT eposta FROM Users WHERE Users.eposta = '$eposta'");
            
            if($emaitza){
                die("Dagoeneko eposta horrekin erregistratutako erabiltzaile bat badago");
            }

            $sartu = mysqli_query($esteka, "INSERT INTO Users(erMota, eposta, deitura, pasahitza) VALUES ('$erMota', '$eposta', '$deitura', '$pasahitza')");

            if (!$sartu){
                die("Errorea erregistreratzerakoan");
            }

            mysqli_close($esteka);
        }
    ?>


  </section>
  <?php include '../html/Footer.html'?>
</body>
</html>
