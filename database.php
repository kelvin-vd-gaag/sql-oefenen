<?php

//Stap 1: Maak een nieuwe database aan in bijvoorbeeld phpmydmin
//Stap 2: Importeer oefendata.sql in de nieuwe database
//stap 3: Configureer database.php zodat deze verbinding kan maken met jouw nieuwe database
//stap 4: Ga naar localhost/sql-oefenen om te beginnen

$username = "root";
$password = "";
$database_name = "sql-oefenen";

try {
    $conn = new PDO("mysql:host=localhost;dbname=$database_name", $username, $password);
} catch (PDOException $error) {
    echo $error->getMessage();
}
