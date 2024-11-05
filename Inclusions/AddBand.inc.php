<?php
// dc connectie
require_once "dbCon.inc.php"; // Verbindt met de database

try {
    // SQL-query om band ID en bandnaam uit de band tabel te selecteren
    $sql = "SELECT idband, bandnaam FROM band";
    // Voer de query uit en sla het resultaat op
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    // Afhandelen fouten die kunnen optreden
    echo "Fout: " . $e->getMessage();
    // Beëindig het script als er een fout optreedt
    die();
}

// Controleerd of het resultaat rijen bevat
if ($result->rowCount() > 0) {
    // Haal elke rij uit het resultaat op als een array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
       // geeft de ID als value en bandnaam als tekst in een optie in het dropdown menu
        echo "<option value='" . ($row["idband"]) . "'>" . ($row["bandnaam"]) . "</option>";
    }
} else {
    // bericht voor als er geen gegevens worden gevonden
    echo "<p>Geen gegevens gevonden</p>";
}