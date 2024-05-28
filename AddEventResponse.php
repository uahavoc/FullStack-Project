<?php


if($_SERVER["REQUEST_METHOD"] =="POST"){
  $naam = $_POST["eventNaam"];
  $datum = $_POST["datum"];
  $tijd = $_POST["tijd"];
  $prijs = $_POST["prijs"];

  try{
    $pdo = new PDO('mysql:host=localhost;dbname=casuscafe;port=3306','root','');
    
    $query = "INSERT INTO optreden (naam, entree, begintijd, datum) VALUES (?, ?, ?, ?);";

    $stmt = $pdo->prepare($query);

    $stmt -> execute([$naam, $prijs, $tijd, $datum]);

    $pdo = null;
    $stmt = null;

    header("location: Admin.php");

    die();
  } catch(PDOException $e){
    die("Query failed". $e->getMessage());

  }
}

else {
  header("location: ../Home.php");
}