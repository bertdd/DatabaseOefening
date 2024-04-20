<?php
try {
  if (isset($_POST["Id"])) {
    require_once "Database.Class.php";
    require_once "Person.Class.php";

    $database = new Database("localhost", "tutorial");
    $database->Open();

    $person = new Person($_POST);
    $person->Save($database);
  }
}
catch (Throwable $ex)
{
  echo "Er ging iets mis: " . $ex->getMessage();
}
?>

<html>
<head></head>
<body>
  <form action="#" method="post">
    <input type="hidden" name="Id"/>
    <table>
      <tr><td><label for="FirstName">Voornaam</label></td><td><input type="text" name="FirstName" /></td></tr>
      <tr><td><label for="LastName">Achternaam</label></td><td><input type="text" name="LastName" /></td></tr>
      <tr><td><label for="Email">Email</label></td><td><input type="email" name="Email" /></td></tr>
    </table>
    <div><input type="submit" value="Opslaan"></div>
  </form>
</body>
</html>
