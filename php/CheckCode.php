<?php
    if (!isset($_SESSION)){
        session_start();
    }
    $code = $_POST["code"];
    if ($code === $_SESSION["code"]){
        $response = [
            'correct' => true
        ];
    } else {
        $response=[
            'correct' => false
        ];
    }
    echo json_encode($response);

?>