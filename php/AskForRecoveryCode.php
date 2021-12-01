<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	  <h1>
      Pasahitza berreskuratzeko eposta sar ezazu:
    </h1>
		<form id="epostaF" method="post" name="epostaF" action="AskForRecoveryCode.php">
	
			<p>Eposta(*): <input type="text" id="eposta" name="eposta" size="40"></p>
			<input	type="submit" id="submit" name="submit" value="Bidali">
			<input 	type="button" id="hustu" name="hustu" value="Hustu" onclick='this.reset()'>

		</form>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      include "DbConfig.php";
      if($_POST['eposta'] === ""){
        echo 'Eposta bat sartu';
      } else {
          $eposta = $_POST["eposta"];
          $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die ("Errorea DB-ra konektatzean");
          $emaitza = mysqli_query($esteka, "SELECT eposta FROM Users WHERE Users.eposta = '{$eposta}'");
          if($emaitza -> num_rows == 0){
            mysqli_free_result($emaitza);
            mysqli_close($esteka);
            die("Eposta okerra");
          }
          $subject = "Pasahitza berreskuratzeko kodea";
          $code = $rand(100000, 999999);
          $message = "Zure pasahitza berreskuratzeko kodea: $code";
          mail($eposta, $subject, $message);
          $_SESSION["code"] = $code;
          $_SESSION["epostatochange"] = $eposta;
          mysqli_free_result($emaitza);
          mysqli_close($esteka);
          header("Location: RecoverPassword.php");
          
      }
    }
    ?>
    </div>
  </section>

  <?php include '../html/Footer.html' ?>
</body>
</html>
