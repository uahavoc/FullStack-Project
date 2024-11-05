<?php




if($_SERVER["REQUEST_METHOD"] =="POST"){
  $band = $_POST["bandNaam"];
  $event = $_POST["eventNaam"];

  try{
    $pdo = new PDO('mysql:host=localhost;dbname=casuscafe;port=3306','root','');
    
    $eventQuery = "SELECT idoptreden FROM optreden WHERE naam = ?";
    $eventstmt = $pdo->prepare($eventQuery);
    $eventstmt -> execute([$event]);
    $eventId = $eventstmt->fetchColumn();

    $bandQuery = "SELECT idband FROM band WHERE bandnaam = ?";
    $bandstmt = $pdo->prepare($bandQuery);
    $bandstmt -> execute([$band]);
    $bandId = $bandstmt->fetchColumn();

    $query = "INSERT INTO band_has_optreden (band_idband, optreden_idoptreden) VALUES(?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt -> execute([$bandId, $eventId]);

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