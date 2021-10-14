<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	
	  Json formatuan gordetako galderak taula batean erakusteko PHP kodea <br/>
      Taulan ez dago irudirik
	  
    </div>

    <?php

	echo '<div align="center"> <table border="1"> <tr><th>Eposta</th> <th>Galdera</th> <th>Erantzun zuzena</th></tr>';

    $data = file_get_contents('../json/Questions.json');
    $array = json_decode($data);



	foreach($array->assessmentItems as $galdera){

	    echo '<tr> <td>'.$galdera->author.'</td> <td>'.$galdera->itemBody->p.'</td><td>'.$galdera->correctResponse->response.'</td></tr>';

	}

	echo '</table> </div>';


    ?>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>