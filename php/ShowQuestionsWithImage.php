<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <style>
     .main{height:auto;}
  </style>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <?php

        include 'DbConfig.php';

        $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db)
        or die("no link");

        $ema = mysqli_query($link, "SELECT id, eposta, galdera, eZuzena, eOkerra1, eOkerra2, eOkerra3, zailtasuna, gaia, argazkia FROM Questions");

        if(!$ema){
            die("no ema");
        }
	echo '<div align="center"> <table border="1"> <tr> <th>ID-a</th> <th>Eposta</th> <th>Galdera</th> <th>Erantzun zuzena</th> <th>Erantzun okerra 1</th> <th>Erantzun okerra 2</th> <th>Erantzun okerra 3</th> <th>Zailtasuna</th> <th>Arloa</th> <th>Argazkia</th> </tr>';

        while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){

            echo '<tr> <td>'.$row['id'].'</td> <td>'.$row['eposta'].'</td> <td>'.$row['galdera'].'</td> <td>'.$row['eZuzena'].'</td> <td>'.$row['eOkerra1'].'</td> <td>'.$row['eOkerra2'].'</td> <td>'
                .$row['eOkerra3'].'</td> <td>'.$row['zailtasuna'].'</td> <td>'.$row['gaia'].'</td>';
	    //echo '<td> <img /> </td></tr>';
	    if($row['argazkia']!=NULL){
	    echo '<td> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['argazkia']).'"/ height=100>';
	    }
	    echo '</tr>';
        }

        echo '</table> </div>';

        mysqli_free_result($ema);
        mysqli_close($link);


    ?>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
