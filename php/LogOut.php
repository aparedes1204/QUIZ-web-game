<?php
include "DecreaseGlobalCounter.php";
if (!isset($_SESSION)){
    session_start();
}
session_destroy();
//echo "<script>window.location.href='Layout.php' alert (Logged out. Agur) </script>";
?>
