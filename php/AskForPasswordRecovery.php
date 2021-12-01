<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/RecoverPassword.js"></script>
  
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	  <h1 id="eginbeharrekoa">
      Pasahitza berreskuratzeko zure eposta sar ezazu. Ondoren jasotako mezuan agertzen de kodea sartu:
    </h1>
		<form id="pasahitzaBerreskuratu" method="post" name="pasahitzaBerreskuratu" action="RecoverPassword.php">
	
			<p>Eposta: <input type="text" id="eposta" name="eposta" size="40"></p>
			<p id="epostaAlert"></p>
            <p>Berreskurapen kodea: <input disabled type="text" id="code" name="code" size="40"></p>
            <p id="codeAlert"></p>
            <div id="pasahitzacontainer" style="display: none">
            <p>Pasahitza berria: <input type="password" id="pasahitza" name="pasahitza" size="40"></p>
            <p>Pasahitza berria errepikatu: <input type="password" id="pasahitzaErrep" name="pasahitzaErrep" size="40"></p>
            </div>
            <p id="pasahitzaAlert"></p>
            <input	type="button" id="emailsubmit" name="emailsubmit" value="Bidali mezua">

		</form>
        </div>
  </section>

  <?php include '../html/Footer.html' ?>
</body>
</html>