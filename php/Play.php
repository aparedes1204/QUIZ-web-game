<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/Play.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
      <div id="content">
      <h3>Aukeratu gai bat</h3>
      <?php
        include "DbConfig.php";
        $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
          or die ("errorea DB-ra konektatzean");
        $emaitza = mysqli_query($esteka, "SELECT distinct gaia FROM Questions");
        $gaiak= [];
        while($row=mysqli_fetch_array($emaitza, MYSQLI_ASSOC)){
          if(!in_array($row["gaia"], $gaiak)){
            echo "<p><input type='button' class ='gaia' id='".$row["gaia"]."' value='".$row["gaia"]."'></p>";
            array_push($gaiak,$row["gaia"]);
          }
        }
        mysqli_free_result($emaitza);
        mysqli_close($esteka);
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>