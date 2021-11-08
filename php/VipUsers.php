<?php

// Datuak eskuratzeko konstanteak ...
DEFINE("_HOST_", "localhost");
DEFINE("_PORT_", "");
DEFINE("_USERNAME_", "root");
DEFINE("_DATABASE_", "quiz");
DEFINE("_PASSWORD_", "");

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
                if (isset($data[0])){echo "<br><br><b>ZORIONAK ".$eposta." VIPa da </b><br><img src=../images/ok.gif>";break;}
                else {echo "<br><br><b>SENTITZEN DUT ".$eposta." Ez da VIPa</b><br><img src=../images/ko.gif>";
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
        case 'PUT':
             // hau ez da inplementatu behar
        case 'DELETE':
             // VIP erabiltzailea ezabatzeko
             $request_vars = array();
             parse_str($this->getContent(), $request_vars);
             echo $request_vars;
             $sql = "DELETE FROM vip WHERE eposta='{$post_vars}'";
             $data = Database::GauzatuEzKontsulta($cnx, $sql);
             if($data){
                 echo "success";
             }
             else{
                 echo "error";
             }
	}
    Database::Deskonektatu($cnx);
	
?>