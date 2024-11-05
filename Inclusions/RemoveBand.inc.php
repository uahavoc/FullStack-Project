<?php
require_once "dbCon.inc.php"; // Verbindt met de database

try {
    // Query om idband en bandnaam te selecteren uit de tabel 'band'
    $sql = "SELECT idband, bandnaam FROM band";
    // Voert de query uit en sla het resultaat op
    $result = $pdo->query($sql); 
} catch(PDOException $e) {
    // geeft een fout melding als het nodig is
    echo "eeeeeeeeeeeeeeeeeror: " . $e->getMessage();
    //stopt het script als een fout optreed
    die();
}

// Controleer of er resultaten zijn gevonden
if ($result->rowCount() > 0) {
    // Doorloop alle gevonden rijen en genereerd een <option> voor elke band
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value=" . $row["idband"] . ">" . $row["bandnaam"] . "</option>";
    }
} else {
    // bericht als er geen resultaten zijn
    echo "<p>Geeeeeeeeeeeeeeeeeeeeeeeeeeeeeen Data</p>";
}