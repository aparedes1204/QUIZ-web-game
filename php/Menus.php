<div id='page-wrap'>
<header class='main' id='h1'>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script src='../js/LogOut.js'></script>
  <?php
      include 'DbConfig.php';
      if (!isset($_SESSION)){
        session_start();
      } 
      if(isset($_SESSION["eposta"])){
        $eposta = $_SESSION["eposta"];
	      $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
      	or die("no link");
	      $ema = mysqli_query($link,"SELECT argazkia FROM Users WHERE Users.eposta = '{$eposta}'");
	      $row=mysqli_fetch_array($ema, MYSQLI_ASSOC);
        echo "Erabiltzailea: $eposta<p><span class='right'><a id=logout href=''>Logout</a></span>";
	      if(isset($row['argazkia']) && $row['argazkia'] != NULL){
        	echo '<td> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['argazkia']).'"/ height=100>';
        }
      } else {
        echo "<span class='right'><a href='SignUp.php'>Erregistratu</a></span>
        <span class='right'><a href='LogIn.php'>Login</a></span>
        <span class='right'><a href='github_login.php'>Login Github-ekin</a></span>
        <span class ='right'><a href='AskForPasswordRecovery.php'>Pasahitza berreskuratu</a></span>";
      }
  ?>
</header>

<nav class='main' id='n1' role='navigation'>
  <?php
  if(isset($_SESSION["eposta"])){
    $eposta = $_SESSION['eposta'];
    
    echo "<span><a href='Layout.php'>Hasiera</a></span>
    <span><a href='Play.php'>Jolastu</a></span>";
    
    if($_SESSION['erMota'] === "irakaslea"){
      echo "<span><a href = 'HandlingQuizesAjax.php'> Kudeatu galderak</a> <span>
      <span><a href = 'IsVip.php'> VIPa da? </a> <span>
      <span><a href = 'AddVip.php'> Gehitu VIPa </a> <span>
      <span><a href='DeleteVip.php'>Ezabatu VIPa</a></span>
      <span><a href='ShowVips.php'>Zerrendatu VIPak</a></span>";
    } else if($_SESSION["erMota"]==="admin"){
        echo "<span><a href='HandlingAccounts.php'>Kontuak kudeatu</a></span>";
    } else if($_SESSION["erMota"] === "ikaslea"){
        echo "<span><a href = 'HandlingQuizesAjax.php'> Kudeatu galderak</a> <span>";
    }
    echo "<span><a href='Credits.php'>Kredituak</a></span>";
  } else {
    echo "<span><a href='Layout.php'>Hasiera</a></span>
    <span><a href='Play.php'>Jolastu</a></span>
    <span><a href='Credits.php'>Kredituak</a></span>";
  }
    
    ?>
</nav>
