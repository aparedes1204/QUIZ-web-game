<?php

    $curl = curl_init();
    $url = "localhost/WS/php/vipusers/imoreno064@ikasle.ehu.eus";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    $str = curl_exec($curl);
    echo $str;
?>