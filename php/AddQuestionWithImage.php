<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <?php
      include 'DbConfig.php';
      $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
        or die ("errorea DB-ra konektatzean");
      $image = $_FILES['choose-file']['tmp_name'];
      $blob = addslashes(file_get_contents($image));

      $eposta = trim($_POST['eposta']);
      $galdera = trim($_POST['galdera']);
      $e_zuzena = trim($_POST['e_zuzena']);
      $e_okerra1 = trim($_POST['e_okerra1']);
      $e_okerra2 = trim($_POST['e_okerra2']);
      $e_okerra3 = trim($_POST['e_okerra3']);
      if (isset($_POST['zailtasuna'])) {
        $zailtasuna = $_POST['zailtasuna'];
      }
      
      $arloa = trim($_POST['arloa']);

      $fields = array($eposta, $galdera, $e_zuzena, $e_okerra1, $e_okerra2, $e_okerra3, $arloa);

      foreach($fields as $elm){
        if (!filter_var($elm,
        FILTER_VALIDATE_REGEXP, 
        array('options' => array('regexp' => '/^.+$/')) ) || !isset($zailtasuna)
        ) {
          die('Fill in every field');
        }
      }


      if (!filter_var($eposta,
          FILTER_VALIDATE_REGEXP, 
          array('options' => array('regexp' => '/^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/')) )
          ) {
            die('Eposta okerra');
          }
      
      if (!filter_var($galdera,
          FILTER_VALIDATE_REGEXP, 
          array('options' => array('regexp' => '/^.{10,}$/')) )
          ) {
            die ('Galdera laburregia (10 karaktere gutxienez)');
          }

      $emaitza = mysqli_query($esteka,"INSERT INTO Questions(eposta, galdera, eZuzena, eOkerra1, eOkerra2, eOkerra3, zailtasuna, gaia, argazkia) VALUES ('$_POST[eposta]','$_POST[galdera]','$_POST[e_zuzena]', '$_POST[e_okerra1]', '$_POST[e_okerra2]', '$_POST[e_okerra3]', $_POST[zailtasuna], '$_POST[arloa]', '{$blob}')");
      if(!$emaitza){
        die("Errorea query-an");
      }
      //mysqli_free_result($emaitza);
      mysqli_close($esteka);
      header("Location: Layout.php?eposta=".$eposta);
      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
