<?php
require_once "dbCon.inc.php"; //connects to database

try {
  // SQL-query om optreden ID en naam uit de optreden tabel te selecteren
  $sql = "SELECT idoptreden, naam FROM optreden";
  // Voert de query uit en slaat het resultaat op
  $result = $pdo->query($sql);
} catch (PDOException $e) {
  // Afhandelen van eventuele fouten 
  echo "Fout: " . $e->getMessage();
  // Beëindig het script als er een fout optreedt
  die();
}

// Controleer of het resultaat rijen bevat
if ($result->rowCount() > 0) {
  // Haal elke rij uit het resultaat op als een array
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      // geeft de ID als value en bandnaam als tekst in een optie in het dropdown menu
      echo "<option value='" . ($row["idoptreden"]) . "'>" . ($row["naam"]) . "</option>";
  }
} else {
  // Als er geen gegevens worden gevonden, geef een bericht weer dat er geen gegevens zijn
  echo "<p>Geen Data</p>";
}