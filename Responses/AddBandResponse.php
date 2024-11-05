<?php
session_start(); // Start de sessie

// Controleerd of het verzoek een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haalt de bandnaam en het genre op uit het POST-verzoek
    $naam = $_POST["bandNaam"];
    $genre = $_POST["bandGenre"];

    try {
        // Verbind met de database
        require_once "../Inclusions/dbCon.inc.php"; 

        // SQL-query om nieuwe band in tabel 'band' te voegen
        $query = "INSERT INTO band (bandnaam, muziekgenre) VALUES (?, ?);";

        // Bereid de query voor
        $stmt = $pdo->prepare($query);

        // Voer de query uit met de opgehaalde gegevens
        $stmt->execute([$naam, $genre]);

        // Maak de databaseverbinding en statement leeg
        $pdo = null;
        $stmt = null;

        // Redirect naar de admin-pagina
        header("location: ../Admin.php");

        die(); // Stopt de scriptuitvoering
    } catch (PDOException $e) {
        // Toon foutmelding als de query faalt
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Als het geen POST-verzoek is, redirect naar de home-pagina
    header("location: ../Home.php");
}