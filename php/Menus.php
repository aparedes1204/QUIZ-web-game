<div id='page-wrap'>
<header class='main' id='h1'>
  <?php
      if(isset($_GET['eposta'])){
        $eposta = $_GET['eposta'];
        echo "Erabiltzailea: $eposta<p><span class='right'><a href='LogOut.php'>Logout</a></span>";
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
    <span><a href='ShowQuestionsWithImage.php?eposta=$eposta'>Galderak</a></span>
    <span><a href='Credits.php?eposta=$eposta'>Kredituak</a></span>";
  } else {
    echo "<span><a href='Layout.php'>Hasiera</a></span>
    <span><a href='Credits.php'>Kredituak</a></span>";
  }
    
    ?>
</nav>
