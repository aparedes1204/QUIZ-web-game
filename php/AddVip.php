<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestionJS.js"></script>-->
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	  
		<form id="galderenF" method="post" name="vipGehitu" action="vipusers">
	
			<p>Eposta(*): <input type="text" id="eposta" name="eposta" size="40"></p>
			<input	type="submit" id="submit" name="submit" value="Bidali">
			<input 	type="button" id="hustu" name="hustu" value="Hustu" onclick='this.reset()'>

		</form>
	
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>