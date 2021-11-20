<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php 
    include 'Security.php';
    if ($_SESSION["erMota"] !== "admin"){
      header("Location: Layout.php");
    }
    include "ChangeUserState.php";
    include "RemoveUser.php";
  ?>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ChangeUserState.js"></script>
  <script src = "../js/RemoveUser.js"></script>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <?php
        $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
        or die ("Errorea DB-ra konektatzean");

        $emaitza = mysqli_query($esteka, "SELECT eposta, pasahitza, egoera, argazkia FROM Users");

        if(!$emaitza){
          die("Ez dago erabiltzailerik");
        }
	      echo '<div align="center"> <table id="userTable" border="1"> <tr> <th>Eposta-a</th> <th>Pasahitza</th> <th>Argazkia</th> <th>Egoera</th> <th>Permutatu</th> <th>Ezabatu</th> </tr>';

        while($row=mysqli_fetch_array($emaitza, MYSQLI_ASSOC)){
          echo '<tr> <td id="eposta">'.$row['eposta'].'</td> <td>'.$row['pasahitza'].'</td>';

	        if($row['argazkia']!=NULL){
	          echo '<td> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['argazkia']).'"/ height=50>';
	        } else {
	          echo '<td> </td>';
          }
          $egoera = $row["egoera"];
          $value = $egoera == "1" ? "ON" : "OFF";
          echo '<td id="egoera">'.$row['egoera'].'</td> <td> <input type="button" id="permutationButton" value="'.$value.'"></td> <td> <input type="button" id="removeButton" value="Ezabatu"></td>';
	        echo '</tr>';
        }
        echo '</table> </div>';


      ?>
    

    


      
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>