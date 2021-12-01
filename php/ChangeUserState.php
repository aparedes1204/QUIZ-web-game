<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $eposta = $_POST["eposta"];
        $egoera = $_POST["egoera"];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
        or die ("Errorea DB-ra konektatzean");
        if($egoera === "Baimenduta"){
            $egoera = "Blokeatuta";
        } else {
            $egoera = "Baimenduta";
        }
        $egoeradb = $egoera == "Baimenduta" ? "1" : "2";
        mysqli_query($esteka, "UPDATE Users SET egoera = '{$egoeradb}' WHERE eposta = '{$eposta}'");
        $response = [
            'egoera' => $egoera,
            'buttonValue' => $egoera == "Baimenduta" ? "Blokeatu" : "Baimendu"
        ];
        echo json_encode($response);
    }
?>