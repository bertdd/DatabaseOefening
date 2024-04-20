<?php
class Person
{
  public int $Id;
  public string $FirstName;
  public string $LastName;
  public string $Email;

  public function __construct(array $data)
  {
    $this->Id = (int) $data["Id"];
    $this->FirstName = $data["FirstName"];
    $this->LastName = $data["LastName"];
    $this->Email = $data["Email"];
  }

  public function Save(Database $database, string $table = "Person") : void
  {
    $sql = !isset($this->Id) || $this->Id == 0 ?
      "insert into $table (Id, FirstName, LastName, Email) values (:Id, :FirstName, :LastName, :Email)" :
      "update $table set FirstName = :FirstName, LastName = :LastName, Email = :Email where Id = :Id";
    $statement = $database->pdo->prepare($sql);
    $statement->execute((array)$this);
  }

  public static function Read(Database $database, int $id, string $table = "Person") : Person
  {
    $statement = $database->pdo->prepare("select * from $table where Id = :id");
    $statement->execute(["id" => $id]);
    $statement->setFetchMode(PDO::FETCH_CLASS, "Person");
    return $statement->fetch();
  }

  public static function Delete(Database $database, int $id, string $table = "Person") : void
  {
    $statement = $database->pdo->prepare("select * from $table where Id = :id");
    $statement->execute(["id" => $id]);
  }

  public static function GetAll(Database $database, string $table = "Person") : array
  {
    $statement = $database->pdo->prepare("select * from $table");
    $statement->setFetchMode(PDO::FETCH_CLASS, "Person");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function __toString() : string
  {
    return "$this->FirstName $this->LastName ($this->Email)";
  }
}