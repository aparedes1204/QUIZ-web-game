<?php

// Datuak eskuratzeko konstanteak ...
DEFINE("_HOST_", "localhost");
DEFINE("_PORT_", "");
DEFINE("_USERNAME_", "T60");
DEFINE("_DATABASE_", "db_T60");
DEFINE("_PASSWORD_", "KQrFOSVCQ6J9u");

require_once 'database.php';
$method = $_SERVER['REQUEST_METHOD'];
$resource = $_SERVER['REQUEST_URI'];

    $cnx = Database::Konektatu();
    switch ($method) {
        case 'GET':
           	if(isset($_GET['eposta']))
			{
                $datuak = "";
                $eposta = $_GET['eposta'];
                $sql = "SELECT * FROM vip WHERE eposta='{$eposta}'";
                echo $sql .' kontsulta exekutatzen dut <p>';
                $data = Database::GauzatuKontsulta($cnx, $sql);
                if (isset($data[0])){echo "<br><br><b>ZORIONAK ".$eposta." VIPa da </b><br><img height=300px src=https://lh3.googleusercontent.com/proxy/ZgOL1p0D2B1jtRAgH_e7FDZyVougtwGKlK3u4fw31QWEe2t05q6xnKiT_tX8Stz_6ITOJXwgjbzjy70f0LY>";break;}
                else {echo "<br><br><b>SENTITZEN DUT ".$eposta." Ez da VIPa</b><br><img height=300px src=https://www.arttdinox.com/assets/web/wrong.gif>";
                break;}
			}
			else
			{
                $sql = "SELECT * FROM vip";
                echo $sql .' kontsulta exekutatzen dut <p>';
                $data = Database::GauzatuKontsulta($cnx, $sql);
                $arraya = array();
                foreach ($data as $item){
                    //  echo $item["eposta"]."\n";
                    array_push($arraya, $item["eposta"]);
                }
                echo json_encode($arraya);
			}
			break;
        case 'POST':
             // VIPa gehitzeko
             $eposta = $_POST["eposta"];
             $sql = "INSERT INTO vip VALUES('{$eposta}')";
             $data = Database::GauzatuEzKontsulta($cnx, $sql);
             if($data){
                 echo "success";
             }
             else{
                 echo "error";
             }
             break;
        case 'PUT':
             // hau ez da inplementatu behar
        case 'DELETE':
             // VIP erabiltzailea ezabatzeko
             $eposta=$_REQUEST['eposta'];
             $sql = "DELETE FROM vip WHERE eposta='{$eposta}'";
             $data = Database::GauzatuEzKontsulta($cnx, $sql);
             if($data){
                 echo "success";
             }
             else{
                 echo "error";
             }
             break;
	}
    Database::Deskonektatu($cnx);
	
?>
