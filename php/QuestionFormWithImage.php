<!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <!--script type="text/javascript" src="../js/ValidateFieldsQuestionJS.js"></script>-->
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestionJQ.js"></script>-->

</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div id="form-with-image" name="form-with-image">

      <form id="galderenF" name="galderenF" method="post" enctype="multipart/form-data" action="AddQuestionWithImage.php">

        <p>Eposta(*): <input type="text" id="eposta" name="eposta" size="40"></p>
        <p>Galdera(*): <input type="text" id="galdera" name="galdera" size="40"></p>
        <p>Erantzun zuzena(*): <input type="text" id="e_zuzena" name="e_zuzena" size="40"></p>
        <p>Erantzun okerra 1(*): <input type="text" id="e_okerra1" name="e_okerra1" size="40"></p>
        <p>Erantzun okerra 2(*): <input type="text" id="e_okerra2" name="e_okerra2" size="40"></p>
        <p>Erantzun okerra 3(*): <input type="text" id="e_okerra3" name="e_okerra3" size="40"></p>
        <p>Zailtasuna(*):
          <input type="radio" id="zailtasuna" name="zailtasuna" value="1">Txikia
          <input type="radio" id="zailtasuna" name="zailtasuna" value="2">Ertaina
          <input type="radio" id="zailtasuna" name="zailtasuna" value="3">Handia
        </p>
        <p>Galderaren gai-arloa(*): <input type="text" id="arloa" name="arloa" size="40"></p>

        <!--<input	type="submit" id="submit" name="submit" value="Bidali" onclick='return ValidateFieldsQuestionJS(eposta, galdera, e_zuzena, e_okerra1, e_okerra2, e_okerra3, zailtasuna, arloa)'>
  -->
        <input type="file" id="choose-file" name="choose-file" accept="image/*" onchange="loadFile(event)">
        <input type="submit" id="submit" name="submit" value="Bidali">
        <input type="button" id="hustu" name="hustu" value="Hustu" onclick='resetForm()'>



      </form>

    </div>
    

    

  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>
