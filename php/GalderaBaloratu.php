<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST["like"]) && isset($_POST["id"])) {
        $id = $_POST["id"];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
          or die ("errorea DB-ra konektatzean");
        mysqli_query($esteka, "UPDATE Questions SET balorazioa = balorazioa+1 WHERE Questions.id = '{$id}'");
        $emaitza = mysqli_query($esteka, "SELECT balorazioa FROM Questions WHERE Questions.id = '{$id}'");
        $balorazioa = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)['balorazioa'];
        echo ("Balorazioa: $balorazioa");
        mysqli_free_result($emaitza);
        mysqli_close($esteka);
    }
    if(isset($_POST["dislike"]) && isset($_POST["id"])) {
        $id = $_POST["id"];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
          or die ("errorea DB-ra konektatzean");
        mysqli_query($esteka, "UPDATE Questions SET balorazioa = balorazioa-1 WHERE Questions.id = '{$id}'");
        $emaitza = mysqli_query($esteka, "SELECT balorazioa FROM Questions WHERE Questions.id = '{$id}'");
        $balorazioa = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)['balorazioa'];
        echo ("Balorazioa: $balorazioa");
        mysqli_free_result($emaitza);
        mysqli_close($esteka);
    }
} else {
    header("Location: Layout.php");
}

?>