<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION["code"])||!isset($_SESSION["epostatochange"])){
        header("Location: Layout.php");
    }
    include "DbConfig.php";
    $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die ("Errorea DB-ra konektatzean");
    $pasahitza = crypt($_POST["pashitza"], rand());
    $eposta = $_SESSION["epostatochange"];
    $emaitza = mysqli_query($esteka, "UPDATE Users SET pasahitza = '{$pasahitza}' WHERE Users.eposta = '{$eposta}'");
    if (!$eaitza){
        die("Errorea pasahitza aldatzean");
    }
    session_destroy();
    mysqli_close($esteka);
    echo "<script>if(window.confirm('Pasahitza zuzen aldatuta')){window.location.href='Layout.php'} </script>";
?>