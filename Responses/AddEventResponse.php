<?php
session_start(); // Start de sessie

// Controleer of het verzoek een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de gegevens van het evenement op uit het POST-verzoek
    $naam = $_POST["eventNaam"];
    $datum = $_POST["datum"];
    $tijd = $_POST["tijd"];
    $prijs = $_POST["prijs"];

    try {
        // Verbind met de database
        require_once "../Inclusions/dbCon.inc.php";

        // SQL-query om nieuw evenement in de tabel 'optreden' te voegen
        $query = "INSERT INTO optreden (naam, entree, begintijd, datum) VALUES (?, ?, ?, ?);";

        // Bereid de query voor
        $stmt = $pdo->prepare($query);

        // Voert de query uit met de opgehaalde gegevens
        $stmt->execute([$naam, $prijs, $tijd, $datum]);

        // Maakt de databaseverbinding en statement leeg
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
    // Als het geen POST-verzoek is, redirect naar de home-pagina
    header("location: ../Home.php");
}