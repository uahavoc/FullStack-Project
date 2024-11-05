<div class="eventList">
<?php
require_once "dbCon.inc.php"; // Verbindt met de database

try {
    // SQL-query om (id, naam, entree, datum, begintijd) uit de optreden tabel te selecteren
    $sqlEvent = "SELECT idoptreden, naam, entree, datum, begintijd FROM optreden";
    // Voer de query uit en sla het resultaat op
    $resultEvent = $pdo->query($sqlEvent);
} catch (PDOException $e) {
    // Afhandelen van fouten tijdens de query uitvoering
    echo "Fout: " . $e->getMessage();
    // Beëindig het script als er een fout optreedt
    die();
}

// Controleer of het resultaat rijen bevat
if ($resultEvent->rowCount() > 0) {
    // Haalt elke rij uit het resultaat op als array
    while ($row = $resultEvent->fetch(PDO::FETCH_ASSOC)) {
        // Begin van een event div
        echo "<div class='event'>";
        // Weergeven van de naam van het optreden
        echo "<h1 class='eventName'>" . ($row["naam"]) . "</h1>";
        echo "<div class='bandsEvent'>";

        try {
            // Haalt het id van het optreden op
            $idEvent = $row["idoptreden"];
            // SQL-query om bandnamen en muziekgenres van de bijbehorende bands van het optreden te selecteren
            $sqlBands = "SELECT bandnaam, muziekgenre FROM band b INNER JOIN band_has_optreden bo ON b.idband = bo.band_idband WHERE bo.optreden_idoptreden = $idEvent";
            // Voer de query uit en sla het resultaat op
            $resultBands = $pdo->query($sqlBands);

            // Sla de bands op in een array
            $bands = $resultBands->fetchAll(PDO::FETCH_ASSOC);

            // Controleer of er bands gevonden zijn
            if (count($bands) > 0) {
                // Weergeven van de artiesten
                echo "<div>";
                echo "<h2>Artiesten</h2>";
                echo "<ul class='bandNaam'>";
                foreach ($bands as $bandRow) {
                    // Weergeven van de naam van de band
                    echo "<li>" . ($bandRow["bandnaam"]) . "</li>";
                }
                echo "</ul>";
                echo "</div>";
                
                // Weergeven van de muziekgenres
                echo "<div>";
                echo "<h2>Genre</h2>";
                echo "<ul class='eventNaam'>";
                foreach ($bands as $bandRow) {
                    // Weergeven van het muziekgenre van de band
                    echo "<li>" . ($bandRow["muziekgenre"]) . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                // Bericht als er geen bands zijn gepland voor dit optreden
                echo "<p>Geen bands gepland voor dit evenement</p>";
            }
        } catch (PDOException $e) {
            // Afhandelen van eventuele fouten die optreden tijdens de query uitvoering
            echo "error: " . $e->getMessage();
        }
        
        // Sluit de bandsEvent div af
        echo "</div>";
        // Weergeven van de datum en aanvangstijd van het optreden
        echo "<div class='eventInfo'>";
        echo "<h3>Datum: " . ($row["datum"]) . "</h3>";
        echo "<h3>Aanvangstijd: " . ($row["begintijd"]) . "</h3>";
        echo "</div>";
        // Weergeven van de prijs van het optreden
        echo "<h3>Prijs: " . ($row["entree"]) . " Euro</h3>";
        // Sluit de event div af
        echo "</div>";
    }
} else {
    // Bericht weergeven als er geen data gevonden is
    echo "<p>no data found</p>";
}
?>
</div>