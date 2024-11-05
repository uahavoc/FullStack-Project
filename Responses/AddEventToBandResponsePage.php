<?php
session_start(); // Start de sessie

// Controleer of het verzoek een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haalt gegevens van band en optreden uit het POST-verzoek
    $band = $_POST["band"];
    $event = $_POST["optreden"];

    try {
        // Verbind met de database
        require_once "../Inclusions/dbCon.inc.php";

        // SQL-query om een band aan een optreden te koppelen
        $query = "INSERT INTO band_has_optreden (band_idband, optreden_idoptreden) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$band, $event]);

        // Maak de databaseverbinding en statement leeg
        $pdo = null;
        $stmt = null;

        // Redirect naar de admin-pagina
        header("location: ../Admin.php");

        die(); // Stop de scriptuitvoering
    } catch (PDOException $e) {
        // Toon een foutmelding als de query faalt
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Als het geen POST-verzoek is, redirect naar home-pagina
    header("location: ../Home.php");
}