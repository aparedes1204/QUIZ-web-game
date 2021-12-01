<?php
if (!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["eposta"])){
    header("Location: Layout.php");
}
?>