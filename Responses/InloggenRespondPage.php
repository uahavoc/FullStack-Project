<?php
session_start();


$host = 'localhost';  // De hostnaam van de database server
$username = 'root'; // De gebruikersnaam voor de database verbinding
$password = ''; // Het wachtwoord voor de database verbinding
$database = 'casuscafe'; // De naam van de database


$conn = ''; // Initialiseer de variabele voor de database verbinding

// Controleer of het verzoek een POST-verzoek is
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"]; // Haal het ingevoerde e-mailadres op uit het POST-verzoek
  $wachtwoord = $_POST["wachtwoord"]; // Haal het ingevoerde wachtwoord op uit het POST-verzoek


  try {
    //connects to database
    require_once "../Inclusions/dbCon.inc.php"; 

  
  } catch (PDOException $e) {
    // Foutmelding bij een mislukte database verbinding
    echo "Connection failed: " . $e->getMessage(); 
  }
}


// Controleerd of e-mail en wachtwoord POST-verzoek zijn
if (isset($_POST['email']) && isset($_POST['wachtwoord'])) {
  if (empty($email)) {
$_SESSION['error'] = "Geen email ingevuld"; // Toon foutmelding als het e-mailadres leeg is
      header("Location: ../Inloggen.php");      
      exit();
  } else if (empty($wachtwoord)) {
    $_SESSION['error'] = "Geen wachtwoord ingevuld"; 
      header("Location: ../Inloggen.php"); // Toon foutmelding als het wachtwoord leeg is
      exit();
  } else {
      // Query om gebruiker op te halen uit database op basis van e-mailadres
      $sql = "SELECT voornaam, achternaam, email, wachtwoord FROM gebruiker WHERE email = :email";
      $query = $pdo->prepare($sql);
      $query->execute(['email' => $email]);
      // Haal het resultaat op als array
      $row = $query->fetch(PDO::FETCH_ASSOC); 

      // Controleerd of de gebruiker is gevonden
      if ($row) {
          // Controleerd of ingevoerde wachtwoord overeenkomt met wachtwoord in de database
          if ($wachtwoord === $row["wachtwoord"]) {
            // Sla de gebruikersnaam op in de sessie
              $_SESSION["user"] = array("naam" => $row["voornaam"]); 
              header("Location: ../Home.php"); // Redirect naar de home-pagina
              exit();
          } else {
              header("Location: ../Inloggen.php"); // Redirect naar inlogpagina bij verkeerd wachtwoord
              exit();
          }
      } else {
          header("Location: ../Inloggen.php"); // Redirect naar inlogpagina als de gebruiker niet is gevonden
          exit();
      }
  }
} else {
  header("Location: ../Inloggen.php"); // Redirect naar de inlogpagina als e-mail of wachtwoord niet zijn getyped
  exit();
}