<?php
include "DecreaseGlobalCounter.php";
if (!isset($_SESSION)){
    session_start();
}
session_destroy();
echo "<script>if(window.confirm('Logging out. Agur')){window.location.href='Layout.php'} </script>";
?>
