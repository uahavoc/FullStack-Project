<?php
session_start();

$host = 'localhost';  // e.g., 'localhost'
$username = 'root';
$password = '';
$database = 'h6opdracht2inlogpagina';

$conn = '';

try {
  // Create a PDO connection
  $dsn = "mysql:host=$host;dbname=$database";
  $conn = new PDO($dsn, $username, $password);

  $sql = $conn->prepare( "SELECT * FROM inlog WHERE email = :email");
  $sql->bindParam(":email", $_POST["email"]);
  $sql->execute();

  $result = $sql->fetchAll(PDO::FETCH_ASSOC);


  if(isset($result[0]["wachtwoord"]) && ($result[0]["wachtwoord"] == $_POST["wachtwoord"])) {
    session_destroy();
    $_SESSION["user"] = $_POST["email"];
    if($_POST["wachtwoord"] === "doetje123")
    {
      echo "succesvol ingelogd als administrator " . $_SESSION["user"];
      header("location:FullStackHome.php");
    } else {
      echo "no autghoritei. ingelogd als " . $_SESSION["user"];
    }

    echo '<br> <a href="opdracht1RespondPagina?logout">uitloggen</a> ';
  } else {
    echo "sorry geen toegang";
  }

  if(isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();

    header("location:./opdracht1.php");
  }

} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}