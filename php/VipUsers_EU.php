<?php

// Datuak eskuratzeko konstanteak ...
DEFINE("_HOST_", "");
DEFINE("_PORT_", "");
DEFINE("_USERNAME_", "");
DEFINE("_DATABASE_", "");
DEFINE("_PASSWORD_", "");

require_once 'database.php';
$method = $_SERVER['REQUEST_METHOD'];
$resource = $_SERVER['REQUEST_URI'];

    $cnx = Database::Konektatu();
    switch ($method) {
        case 'GET':
           	if(isset($_GET['id']))
			{
            $datuak = "";
            $id = $_GET['id'];
			$sql = "SELECT * FROM users WHERE user_id=$id;";
            echo $sql .' kontsulta exekutatzen dut <p>';
            $data = Database::GauzatuKontsulta($cnx, $sql);
			if (isset($data[0])){echo "<br><br><b>ZORIONAK ".$id." VIPa da </b><br><img src=../images/ok.gif>";break;}
			else {echo "<br><br><b>SENTITZEN DUT ".$id." Ez da VIPa</b><br><img src=../images/ko.gif>";
			break;}
			}
			else
			{
				// Vipak zerrendatzeko zerbitzua (parametro gabeko GETa)
			}
			break;
        case 'POST':
             // VIPa gehitzeko
        case 'PUT':
             // hau ez da inplementatu behar
        case 'DELETE':
             // VIP erabiltzailea ezabatzeko
    
	}
    Database::Deskonektatu($cnx);
	
?>