<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST["erantzuna"]) && isset($_POST["id"])) {
        $id = $_POST["id"];
        $erantzuna = $_POST["erantzuna"];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
          or die ("errorea DB-ra konektatzean");
        $emaitza = mysqli_query($esteka, "SELECT eZuzena FROM Questions WHERE Questions.id = '{$id}'");
        $erantzunZuzena = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)["eZuzena"];
        $response = [
            "correct" => $erantzuna === $erantzunZuzena
        ];
        mysqli_free_result($emaitza);
        mysqli_close($esteka);
        echo json_encode($response);
    }
} else {
    header("Location: Layout.php");
}

?>