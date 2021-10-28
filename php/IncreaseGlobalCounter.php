<?php
$xml = simplexml_load_file('../xml/UserCounter.xml');
$increased = $xml->number+1;
$xml->number = $increased;
$xml->asXML('../xml/UserCounter.xml');
?>