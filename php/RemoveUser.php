<?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
        or die ("Errorea DB-ra konektatzean");
        $eposta = $_POST["eposta"];
        mysqli_query($esteka, "DELETE FROM Users WHERE eposta = '{$eposta}'");
    }

?>