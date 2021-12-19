<!--<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div id="response">-->
      <?php
      include 'DbConfig.php';
      $esteka = mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db)
        or die ("errorea DB-ra konektatzean");
      $image = $_FILES['choose-file']['tmp_name'];
      if($image)
        $blob = addslashes(file_get_contents($image));

      $eposta = trim($_POST['eposta']);
      $galdera = trim(preg_replace ("/\n/", ' ', $_POST['galdera']));
      $e_zuzena = trim(preg_replace ("/\n/", ' ', $_POST['e_zuzena']));
      $e_okerra1 = trim(preg_replace ("/\n/", ' ', $_POST['e_okerra1']));
      $e_okerra2 = trim(preg_replace ("/\n/", ' ', $_POST['e_okerra2']));
      $e_okerra3 = trim(preg_replace ("/\n/", ' ', $_POST['e_okerra3']));
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


      // if (!filter_var($eposta,
      //     FILTER_VALIDATE_REGEXP, 
      //     array('options' => array('regexp' => '/^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/')) )
      //     ) {
      //       die('Eposta okerra');
      //     }
      
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
      
      mysqli_close($esteka);

      $xml = simplexml_load_file('../xml/Questions.xml');
      $galderaXml = $xml->addChild('assessmentItem');
      $galderaXml -> addAttribute('author',$eposta);
      $galderaXml -> addAttribute('subject',$arloa);
      $body = $galderaXml -> addChild('itemBody');
      $body -> addChild('p',$galdera);
      $erantzunZuzena = $galderaXml -> addChild('correctResponse');
      $erantzunZuzena -> addChild('response',$e_zuzena);
      $erantzunOkerrak = $galderaXml->addChild('incorrectResponses');
      $erantzunOkerrak -> addChild('response',$e_okerra1);
      $erantzunOkerrak -> addChild('response',$e_okerra2);
      $erantzunOkerrak -> addChild('response',$e_okerra3);

      if($xml -> asXML('../xml/Questions.xml')){
        echo '<script> alert("Datuak ondo gorde dira XML-an")</script>';
      }else{
        echo '<script> alert("Datuak ez dira ondo gorde XML-an")</script>';
      }
      
      
      $data = file_get_contents('../json/Questions.json');
      $array = json_decode($data);
      $galderaJson = new stdClass();
      $galderaJson -> subject = $arloa;
      $galderaJson -> author = $eposta;
      @$galderaJson -> itemBody -> p = $galdera;
      @$galderaJson -> correctResponse -> response = $e_zuzena;
      @$galderaJson -> incorrectResponse -> response[0] = $e_okerra1;
      $galderaJson -> incorrectResponse -> response[1] = $e_okerra2;
      $galderaJson -> incorrectResponse -> response[2] = $e_okerra3;

      $galderaJsonArray[0] = $galderaJson;
      array_push($array->assessmentItems,$galderaJsonArray[0]);
      $jsonData = json_encode($array);
      $jsonData = str_replace('{', '{'.PHP_EOL, $jsonData);
      $jsonData = str_replace(',', ','.PHP_EOL, $jsonData);
      $jsonData = str_replace('}', PHP_EOL.'}', $jsonData);
      if(file_put_contents('../json/Questions.json',$jsonData)){
        echo '<script> alert("Datuak ondo gorde dira JSON-ean")</script>';
      }else{
        echo '<script> alert("Datuak ez dira ondo gorde JSON-ean")</script>';
      }

      ?>
<!--
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
    -->