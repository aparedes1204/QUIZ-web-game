
<?php
  if($_SERVER['REQUEST_METHOD']=="POST"){
    session_start();
    include "DbConfig.php";
    if(isset($_POST["mail"])) { 
      if($_POST['eposta'] === ""){
        $response = [
          'correct' => false
        ];
      } else {
          $eposta = $_POST["eposta"];
          $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die ("Errorea DB-ra konektatzean");
          $emaitza = mysqli_query($esteka, "SELECT eposta FROM Users WHERE Users.eposta = '{$eposta}'");
          if($emaitza -> num_rows == 0){
            $response = [
              'correct' => false
            ];
          } else {
            $response = [
              'correct' => true
            ];
            $subject = "Pasahitza berreskuratzeko kodea";
            $code = rand(1000,9999);
            $message = "Zure pasahitza berreskuratzeko kodea: $code";
            //mail($eposta, $subject, $message);
            //$_SESSION["code"] = strval($code);
          }
          mysqli_free_result($emaitza);
          mysqli_close($esteka);
          echo json_encode($response);

      }
    }
    if(isset($_POST["validate"])){
      if($_POST["code"] == "1234"){
        $response = [
          'correct' => true
        ];
      } else {
        $response = [
          'correct' => false
        ];
      }
      session_destroy();
      echo json_encode($response);
    }
    if(isset($_POST["pasahitza"])){
      if (!filter_var($_POST["pasahitza"],
      FILTER_VALIDATE_REGEXP, 
      array('options' => array('regexp' => '/^(\S){8,}$/')) )
      ) {
        $response = [
          'correct' => 1
        ];
      } else {
        if($_POST["pasahitza"]!==$_POST["pasahitzaErrep"]){
          $response = [
            'correct' => 2
          ];
        } else {
          $pasahitza = crypt($_POST["pasahitza"], rand());
          $eposta = $_POST["eposta"];
          $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die ("Errorea DB-ra konektatzean");
          $emaitza = mysqli_query($esteka, "UPDATE Users SET pasahitza = '{$pasahitza}'WHERE Users.eposta = '{$eposta}'");
          if (!$emaitza){
            $response = [
              'correct' => 3
            ];
          } else {
           $response = [
              'correct' => 0
            ];
          }
        }
      }
      echo json_encode($response);
      }
  } else {
    header("Location: Layout.php");
  }
?>
