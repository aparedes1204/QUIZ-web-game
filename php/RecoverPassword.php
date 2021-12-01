<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php 
    if(!isset($_SESSION)){
      session_start();
    }
    if(!isset($_SESSION["code"])||!isset($_SESSION["epostatochange"])){
      header("Location: Layout.php");
    }
  ?>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/CheckCode.js"></script>
  
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	  <h1>
      Sartu epostan jasotako kodea. Ondoren eposta sartu eta pasahitza berria sartu
    </h1>
		<form id="pasahitzaF" method="post" name="pasahitzaF" action="ChangePassword.php">
	
			<p>Berreskuratze kodea: <input type="text" id="code" name="code" size="40"></p>
      <p id="codeAlert" name="codeAlert"></p>
      <p>Pasahitza berria: <input type="password" disabled id="pasahitza" name="pasahitza" size="40"></p>
      <p>Pasahitza berria errepikatu: <input type="password" disabled id="pasahitzaErrep" name="pasahitzaErrep" size="40"></p>
      <p id="pasahitzaAlert" name="pasahitzaAlert"></p>
			<input	type="submit" disabled id="submit" name="submit" value="Bidali" onclick=" return validatePasswords()">
			<input 	type="button" id="hustu" name="hustu" value="Hustu" onclick='this.reset()'>

		</form>
    </div>
  </section>

  <?php include '../html/Footer.html' ?>
</body>
</html>
