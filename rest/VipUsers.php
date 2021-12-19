<?php

//Datuak eskuratzeko konstanteak ...
DEFINE("_HOST_", "localhost");
DEFINE("_PORT_", "");
DEFINE("_USERNAME_", "aparedes009");
DEFINE("_DATABASE_", "db_aparedes009");
DEFINE("_PASSWORD_", "KkDMwMXZkVmchBXY");

// DEFINE("_HOST_", "localhost");
// DEFINE("_PORT_", "");
// DEFINE("_USERNAME_", "root");
// DEFINE("_DATABASE_", "quiz");
// DEFINE("_PASSWORD_", "");


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
            if(isset($_GET['rank'])){
                $sql = "SELECT eposta, eZuzenak, eOkerrak FROM vip";
                $data = Database::GauzatuKontsulta($cnx, $sql);
                $players = array_filter($data, function($k){
                    return $k['eZuzenak'] != 0 || $k['eOkerrak'] != 0;
                });
                $rankingsize = $_GET['rank'] > strval(count($players)) ? count($players) : 10;
                $rates = array_map(function($item) {
                    if($item["eZuzenak"] != 0 || $item["eOkerrak"] != 0){
                        return $item["eZuzenak"]/($item["eZuzenak"] + $item["eOkerrak"]);
                    } else {
                        return -1;
                    }
                }, $data);
                $topplayers = array();
                for($i=0; $i<$rankingsize;$i++){
                    $maxindex = array_keys($rates, max($rates))[0];
                    $topplayers [] = $data[$maxindex];
                    $topplayers[$i]["rate"] = $rates[$maxindex];
                    unset($rates[$maxindex]);
                    unset($data[$maxindex]);
                }
                echo '<table border="1" style="margin-left:auto;margin-right:auto;"> <tr><th>Eposta</th> <th>Erantzun zuzenak</th> <th>Erantzun okerrak</th> <th>Asmatze indizea</th></tr>';
                foreach($topplayers as $player){
                    echo '<tr> <td>'.$player['eposta'].'</td> <td>'.$player['eZuzenak'].'</td><td>'.$player['eOkerrak'].'</td> <td>'.$player['rate'].'</td></tr>';
                }
                echo '</table>';
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
            if(isset($_POST["eZuzenak"]) && isset($_POST["eOkerrak"])){
                $eposta = $_POST["eposta"];
                $eZuzenak = $_POST["eZuzenak"];
                $eOkerrak = $_POST["eOkerrak"];
                if($eZuzenak == 0 && $eOkerrak == 0){
                    echo "success";
                    exit();
                }
                $sql1 = "UPDATE vip SET eZuzenak = eZuzenak + {$eZuzenak} WHERE vip.eposta = '{$eposta}'";
                $sql2 = "UPDATE vip SET eOkerrak = eOkerrak + {$eOkerrak} WHERE vip.eposta = '{$eposta}'";
                $data1 = Database::GauzatuEzKontsulta($cnx, $sql1);
                $data2 = Database::GauzatuEzKontsulta($cnx, $sql2);
                if($data1 ||  $data2){
                    echo "success";
                } else {
                    echo "error";
                }
                
            } else {
                // VIPa gehitzeko
                $eposta = $_POST["eposta"];
                $sql = "INSERT INTO vip (eposta) VALUES('{$eposta}')";
                $data = Database::GauzatuEzKontsulta($cnx, $sql);
                if($data){
                    echo "success";
                }
                else{
                    echo "error";
                }
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
