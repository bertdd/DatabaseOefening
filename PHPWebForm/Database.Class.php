<?php
class Database
{
  public function __construct(string $server, string $database,
                              string $userId = "root", string $password = "", int $port = 3306)
  {
    $this->Server = $server;
    $this->Database = $database;
    $this->UserId = $userId;
    $this->Password = $password;
    $this->Port = $port;

    $this->connectionString = "mysql:host=$server;port=$port;dbname=$database";
  }

  public function Open() : void
  {
    $this->pdo = new PDO($this->connectionString, $this->UserId, $this->Password);
  }

  public string $Server;
  public string $Database;
  public string $UserId;
  public string $Password;
  public int $Port;
  public PDO $pdo;
  private string $connectionString;
}