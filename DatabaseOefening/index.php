<?php

require_once "Database.Class.php";
require_once "Person.Class.php";

// open database
$database = new Database("localhost", "tutorial");
$database->Open();

// create and save new person
$person = new Person();
$person->FirstName = "Piet";
$person->LastName = "Jansen";
$person->Email = "piet@coldmail.com";
$person->Save($database);

// read a person and update its email
$person = Person::Read($database, 2);
$person->Email = "piet@me.com";
$person->Save($database);

// delete a person (with id 4)
Person::Delete($database, 4);

// list all persons
foreach (Person::GetAll($database) as $person)
{
  echo $person . PHP_EOL;
}