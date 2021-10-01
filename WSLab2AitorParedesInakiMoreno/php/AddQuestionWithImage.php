<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
			Irudia duen galdera bat gehitzeko PHP kodea
      <?php
      include 'DbConfig.php';
      $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
        or die ("errorea DB-ra konektatzean");
      $image = $_FILES['choose-file']['tmp_name'];
      $blob = addslashes(file_get_contents($image));


      $emaitza = mysqli_query($esteka,"INSERT INTO Questions(eposta, galdera, eZuzena, eOkerra1, eOkerra2, eOkerra3, zailtasuna, gaia, argazkia) VALUES ('$_POST[eposta]','$_POST[galdera]','$_POST[e_zuzena]', '$_POST[e_okerra1]', '$_POST[e_okerra2]', '$_POST[e_okerra3]', $_POST[zailtasuna], '$_POST[arloa]', '{$blob}')");
      if(!$emaitza){
        die("Errorea query-an");
      }
      mysqli_close($emaitza);
      mysqli_close($esteka);
      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
