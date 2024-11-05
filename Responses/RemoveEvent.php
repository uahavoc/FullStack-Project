<?php
require_once "../Inclusions/dbCon.inc.php"; // Verbindt met de database

// Controleer of het een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST["event"]; // Haal het evenement-ID op uit het POST-verzoek

    try {
        // Query om relaties tussen bands en optredens te verwijderen op basis van het evenement-ID
        $query = "DELETE FROM band_has_optreden WHERE optreden_idoptreden = $ID;";
        $stmt = $pdo->exec($query);

        // Query om het optreden te verwijderen op basis van het evenement-ID
        $query2 = "DELETE FROM optreden WHERE idoptreden = $ID;";
        $stmt2 = $pdo->exec($query2);

        // Sluit de database verbinding en zet de statement variabelen op null
        $pdo = null;
        $stmt = null;

        // Redirect naar de Admin pagina
        header("location: ../Admin.php");
        // Stopt de scriptuitvoering
        die();
    } catch (PDOException $e) {
        // Toon foutmelding bij een mislukte query
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Redirect naar de Home pagina als het verzoek geen POST-verzoek is
    header("location: ../Home.php");
}