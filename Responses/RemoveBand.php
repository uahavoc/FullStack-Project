<?php
require_once "../Inclusions/dbCon.inc.php"; // Verbindt met de database

// Controleerd of verzoek een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST["band"]; // Haal het band-ID op uit POST-verzoek

    try {
        // Query om de bandoptreden relatie te verwijderen op basis van band-ID
        $query = "DELETE FROM band_has_optreden WHERE band_idband = $ID;";
        $stmt = $pdo->exec($query);

        // Query om de band te verwijderen op basis van band-ID
        $query2 = "DELETE FROM band WHERE idband = $ID;";
        $stmt2 = $pdo->exec($query2);

        // Sluit de database verbinding en zet de statement variabelen op null
        $pdo = null;
        $stmt = null;

        // Redirect naar de Admin pagina
        header("location: ../Admin.php");
        // Stop de scriptuitvoering
        die();
    } catch (PDOException $e) {
      // Toon foutmelding bij een mislukte query
        die("Query failed: " . $e->getMessage()); 
    }
} else {
    // Redirect naar de Home pagina als het verzoek geen POST-verzoek is
    header("location: ../Home.php");
}