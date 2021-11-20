<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $eposta = $_POST["eposta"];
        $egoera = $_POST["egoera"];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
        or die ("Errorea DB-ra konektatzean");
        if($egoera === "1"){
            $egoera = "2";
        } else {
            $egoera = "1";
        }
        mysqli_query($esteka, "UPDATE Users SET egoera = '{$egoera}' WHERE eposta = '{$eposta}'");
        $response = [
            'egoera' => $egoera,
            'buttonValue' => $egoera == "1" ? "ON" : "OFF"
        ];
        echo json_encode($response);
    }
?>