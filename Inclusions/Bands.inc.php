<?php
require_once "dbCon.inc.php"; // Verbindt met de database

try {
    // SQL-query select bandnaam en muziekgenre uit de band tabel
    $sql = "SELECT bandnaam, muziekgenre FROM band";
    // Voer de query uit en sla het resultaat op
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    // Afhandelen van fouten tijdens de query uitvoering
    echo "Fout: " . $e->getMessage();
    // Beëindig het script als er een fout optreedt
    die();
}

// Start de eerste lijst sectie
echo "<div class='list'>";
echo "<h3 class='anotherlist'>Band</h3>";
echo "<ul class='bandlist'>";

// Controleer of het resultaat rijen bevat
if ($result->rowCount() > 0) {
    // Haal elke rij uit het resultaat op als array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Geeft een HTML lijst element weer met de bandnaam
        echo "<li>" . ($row["bandnaam"]) . "</li>";
    }
} else {
    // bericht als er geen gegevens zijn
    echo "<p>Geen Data</p>";
}

// Sluit de eerste lijst sectie af
echo "</ul>";
echo "</div>";

// Herstart de query om de resultaten opnieuw te gebruiken
$result->execute();

// Start de tweede lijst sectie
echo "<div class='list'>";
echo "<h3 class='anotherlist'>Genre</h3>";
echo "<ul class='bandlist'>";

// Controleer of het resultaat enige rijen bevat
if ($result->rowCount() > 0) {
    // Haal elke rij uit het resultaat op als array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Geef een HTML lijst element weer met het muziekgenre
        echo "<li>" . ($row["muziekgenre"]) . "</li>";
    }
} else {
    // bericht als er geen gegevens worden gevonden
    echo "<p>Geen Data</p>";
}

// Sluit de tweede lijst sectie af
echo "</ul>";
echo "</div>";