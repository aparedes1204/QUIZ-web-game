<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_POST['eposta'] === ""){
        echo 'Eposta bat sartu';
    } else {
        $curl = curl_init();
        $url = 'https://sw.ikasten.io/~aparedes009/rest/VipUsers/'.$_POST['eposta'];
        //$url = "localhost/WS/rest/VipUsers/".$_POST['eposta'];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        $str = curl_exec($curl);
        if(strpos($str, "ZORIONAK")!= false) {
            $eZuzenak = $_POST["eZuzenak"];
            $eOkerrak = $_POST["eOkerrak"];
            $eposta = $_POST["eposta"];
            $curl = curl_init();
            $url = 'https://sw.ikasten.io/~aparedes009/rest/VipUsers';
            //$url = "localhost/WS/rest/VipUsers";
            $data=array('eposta' => $eposta, 'eZuzenak' => $eZuzenak, 'eOkerrak' => $eOkerrak);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $str = curl_exec($curl);
            echo $str;
        } else {
            echo "error vip";
        }
    }
} else {
    header("Location: Layout.php");
}

?>
