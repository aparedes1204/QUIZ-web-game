<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST["gaia"])) {
        $gaia = $_POST["gaia"];
        $response =[];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
          or die ("errorea DB-ra konektatzean");
        $emaitza = mysqli_query($esteka, "SELECT id FROM Questions WHERE Questions.gaia = '{$gaia}'");
        while($row=mysqli_fetch_array($emaitza, MYSQLI_ASSOC)){
           array_push($response, $row["id"]); 
        }
        shuffle($response);
        $data["response"] = $response;
        mysqli_free_result($emaitza);
        mysqli_close($esteka);
        echo json_encode($data);
    }
    if(isset($_POST["id"])) {
        $id = $_POST["id"];
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
          or die ("errorea DB-ra konektatzean");
        $emaitza = mysqli_query($esteka, "SELECT galdera, eZuzena, eOkerra1, eOkerra2, eOkerra3, argazkia, gaia, balorazioa FROM Questions WHERE Questions.id = '{$id}'");
        $array = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
        $galdera = $array['galdera'];
        $eZuzena = $array['eZuzena'];
        $eOkerra1 = $array['eOkerra1'];
        $eOkerra2 = $array['eOkerra2'];
        $eOkerra3 = $array['eOkerra3'];
        $erantzunak=[];
        array_push($erantzunak,$eZuzena);
        array_push($erantzunak,$eOkerra1);
        array_push($erantzunak,$eOkerra2);
        array_push($erantzunak,$eOkerra3);
        shuffle($erantzunak);
        if($array['argazkia']!=NULL){
            $argazkia = $array['argazkia'];
        }
        $gaia = $array['gaia'];
        $balorazioa = $array['balorazioa'];
        echo("
        <form id='questionF'>
            <h4 id='galdera'>$galdera</h4>
            <h5 id='balorazioa'>Balorazioa: $balorazioa</h5>
            <p>
            <input type='button' id='like' value='Like'>
            <input type='button' id='dislike' value='Dislike'>
            </p>
            ");
            if(isset($argazkia)){
                
                echo ("<img src='data:image/jpg;charset=utf8;base64,".base64_encode($argazkia)."' height=200px>");
            }
        $i = 0;
        foreach($erantzunak as $erantzuna){
            echo("
                <p id='erantzuna".$i."'>
                <input type='radio' id='erantzuna' name='erantzuna' value='".$i."'>$erantzuna
                </p>
            ");
            $i++;
        }
        echo("
            <p>
            <input type='button' id='erantzun' value='Erantzun'>
            <input disabled type='button' id='hurrengoa' value='Hurrengo galdera'>
            </p>
            <p>
            <input type='button' id='emaitzak' value='Irten'>
            </p>
            <p id='erantzuninfor'>
            </p>
        </form>
        ");
        mysqli_free_result($emaitza);
        mysqli_close($esteka);
    }
} else {
    header("Location: Layout.php");
}

?>