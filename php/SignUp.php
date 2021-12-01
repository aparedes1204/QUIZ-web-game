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
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ValidateFieldsQuestionJQ.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div id = "sign-up" name = "sign-up">
        <h1>Erregistroa</h1>

        <form id = "sign-up-form" name = "sign-up-form" enctype = "multipart/form-data" method = "post" action="SignUp.php">
            <p>Erabiltzaile mota (*):
              <input type="radio" id="erMota" name="erMota" value="ikaslea">Ikaslea
              <input type="radio" id="erMota" name="erMota" value="irakaslea">Irakaslea
            </p>
            <p>Eposta (*):<input type="text" id="eposta" name="eposta"><p>
            <p id="epostaAlert" name="epostaAlert"></p>             
            <p>Deitura (*):<input type="text" id="deitura" name="deitura"><p>
            <p>Pasahitza (*):<input type="password" id="pasahitza" name="pasahitza"><p>
            <p>Pasahitza errepikatu (*):<input type="password" id="pasahitzaErrep" name="pasahitzaErrep"><p>
            <input type="file" id="irudia" name="irudia" accept="image/*" onchange="loadFile(event)">
	          <input type="button" id="hustu" name="hustu" value="Hustu" onclick="reset()">
            <input type="submit" disabled id="submit" name="submit"  value="Bidali">
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
            
            $erMota = trim($_POST['erMota']);
            $eposta = trim($_POST['eposta']);
            $deitura = $_POST['deitura'];
            $deitura = trim(preg_replace("/\s+/",' ',$_POST['deitura']));
            $pasahitza = $_POST['pasahitza'];
            $pasahitzaErrep = $_POST['pasahitzaErrep'];
	          $image = $_FILES['irudia']['tmp_name'];
      	    $blob = addslashes(file_get_contents($image));

            if (!isset($erMota) || $eposta ==="" || $deitura === "" || $pasahitza === "" || $pasahitzaErrep === "") {
                die ("Bete beharrezkoak (*) diren eremu guztiak");
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

            if($eposta === "admin@ehu.es"){
              $erMota = "admin";
            }
            $stmt = $dbh->prepare("SELECT eposta FROM Users WHERE Users.eposta = ?");
            $stmt->bindParam(1, $eposta);
            $stmt->execute();
            //$emaitza = mysqli_query($esteka, "SELECT eposta FROM Users WHERE Users.eposta = '{$eposta}'");
            
            if($stmt -> rowCount() != 0){
                die("Dagoeneko eposta horrekin erregistratutako erabiltzaile bat badago");
            }
            $pasahitza = crypt($pasahitza, rand());
            $stmt = $dbh->prepare("INSERT INTO Users (erMota, eposta, deitura, pasahitza, argazkia) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $erMota);
            $stmt->bindParam(2, $eposta);
            $stmt->bindParam(3, $deitura);
            $stmt->bindParam(4, $pasahitza);
            $stmt->bindParam(5, $blob,PDO::PARAM_BLOB);
            $stmt->execute();
            //$sartu = mysqli_query($esteka, "INSERT INTO Users(erMota, eposta, deitura, pasahitza, argazkia) VALUES ('$erMota', '$eposta', '$deitura', '$pasahitza', '{$blob}')");

            // if (!$sartu){
            //     die("Errorea erregistreratzerakoan");
            // }

            //mysqli_close($esteka);
            $dbh = null;
            echo "<script>if(window.confirm('Zuzen erregistratuta')){window.location.href='Layout.php'} </script>";
        }
    ?>


  </section>
  <?php include '../html/Footer.html'?>
</body>
</html>
