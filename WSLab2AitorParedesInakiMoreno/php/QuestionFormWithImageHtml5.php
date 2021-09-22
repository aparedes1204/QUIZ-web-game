<!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <script type="text/javascript" src="../js/reset.js"></script>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <form id="galderenF" name="galderenF" action="AddQuestion.php">

        <p>Eposta(*): <input type="text" id="eposta" name="eposta" size="40" pattern="^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$" required></p>
        <p>Galdera(*): <input type="text" id="galdera" name="galdera" size="40" pattern=".{10,}" required></p>
        <p>Erantzun zuzena(*): <input type="text" id="e_zuzena" name="e_zuzena" size="40" required></p>
        <p>Erantzun okerra 1(*): <input type="text" id="e_okerra1" name="e_okerra1" size="40" required></p>
        <p>Erantzun okerra 2(*): <input type="text" id="e_okerra2" name="e_okerra2" size="40" required></p>
        <p>Erantzun okerra 3(*): <input type="text" id="e_okerra3" name="e_okerra3" size="40" required></p>
        <p>Zailtasuna(*):
          <input type="radio" id="zailtasuna" name="zailtasuna" value="1" required>Txikia
          <input type="radio" id="zailtasuna" name="zailtasuna" value="2" required>Ertaina
          <input type="radio" id="zailtasuna" name="zailtasuna" value="3" required>Handia
        </p>
        <p>Galderaren gai-arloa(*): <input type="text" id="arloa" name="arloa" size="40" required></p>

        <input type="file" id="choose-file" name="choose-file" accept="image/png, image/jpeg" onchange="loadFile(event)">
        <input type="submit" id="submit" name="submit" value="Bidali">
        <input type="button" id="hustu" name="hustu" value="Hustu" onclick='resetForm()'>

      </form>

      <img id="img-preview" height = "300"/>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>