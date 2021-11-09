<?php
    $client = new SoapClient('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl');
    if ($client->egiaztatuE($_POST["eposta"]) === "BAI"){
        $response = [
            'enrolled' => true
        ];
    } else {
        $response=[
            'enrolled' => false
        ];
    }
    echo json_encode($response);

?>