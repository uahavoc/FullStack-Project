<?php
require_once "dbCon.inc.php"; // Verbindt met de database

try {
    // Query om idoptreden en naam te selecteren uit de tabel 'optreden'
    $sql = "SELECT idoptreden, naam FROM optreden";
    // Voer de query uit en sla het resultaat op
    $result = $pdo->query($sql); 
} catch(PDOException $e) {
    // Als er een fout optreedt, toon een foutmelding en stop de scriptuitvoering
    echo "eeeeeeeeeeeeeeeeeror: " . $e->getMessage();
    die();
}

// Controleer of er resultaten zijn gevonden
if ($result->rowCount() > 0) {
    // gaat door rijen en maakt een <option> voor elk optreden
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value=" . $row["idoptreden"] . ">" . $row["naam"] . "</option>";
    }
} else {
    // bij geen resultaten toont een bericht
    echo "<p>Geeeeeeeeeeeeeeeeeeeeeeeeeeeeeen Data</p>";
}