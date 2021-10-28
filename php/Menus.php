<div id='page-wrap'>
<header class='main' id='h1'>
  <?php
      include 'DbConfig.php';
      if(isset($_GET['eposta'])){
        $eposta = $_GET['eposta'];
	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
	or die("no link");
	$ema = mysqli_query($link,"SELECT argazkia FROM Users WHERE Users.eposta = '{$eposta}'");
	$row=mysqli_fetch_array($ema, MYSQLI_ASSOC);
        echo "Erabiltzailea: $eposta<p><span class='right'><a href='LogOut.php'>Logout</a></span>";
	if($row['argazkia']!=NULL){
        	echo '<td> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['argazkia']).'"/ height=100>';
        }
      } else {
        echo "<span class='right'><a href='SignUp.php'>Erregistratu</a></span>
        <span class='right'><a href='LogIn.php'>Login</a></span>";
      }
  ?>
</header>

<nav class='main' id='n1' role='navigation'>
  <?php
  if(isset($_GET['eposta'])){
    $eposta = $_GET['eposta'];
    echo "<span><a href='Layout.php?eposta=$eposta'>Hasiera</a></span> 
    <span><a href = 'QuestionFormWithImage.php?eposta=$eposta'> Galdera gehitu</a> <span>
    <span><a href = 'HandlingQuizesAjax.php?eposta=$eposta'> Kudeatu galderak</a> <span>
    <span><a href='ShowQuestionsWithImage.php?eposta=$eposta'>Galderak</a></span>
    <span><a href='ShowXmlQuestions.php?eposta=$eposta'>Ikusi xml galderak</a></span>
    <span><a href='ShowJsonQuestions.php?eposta=$eposta'>Ikusi json galderak</a></span>
    <span><a href='Credits.php?eposta=$eposta'>Kredituak</a></span>";
  } else {
    echo "<span><a href='Layout.php'>Hasiera</a></span>
    <span><a href='Credits.php'>Kredituak</a></span>";
  }
    
    ?>
</nav>
