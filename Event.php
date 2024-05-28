<div class="eventList">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=casuscafe;port=3306','root','');

try {
    $sqlEvent = "SELECT idoptreden, naam, entree, datum, begintijd FROM optreden";
    $resultEvent= $pdo->query($sqlEvent);
} catch(PDOException $e) {
    echo "Error: ". $e->getMessage();
    die();
}

if($resultEvent->rowCount() > 0) {
    while($row = $resultEvent->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='event'>";
        echo "<p class='eventName'>".$row["naam"]."</p>";
        echo "<div class='eventInfo'>";
        echo "<p>Datum: ".$row["datum"]."</p>";
        echo "<p>Aanvangstijd: ".$row["begintijd"]."</p>";
        echo "<p>Prijs: ".$row["entree"]." Euro</p>";
        echo "</div>";
        echo "<div class='bandsEvent'>";

        try {
            $idEvent = $row["idoptreden"];
            $sqlBands = "SELECT bandnaam, muziekgenre FROM band b INNER JOIN band_has_optreden bo ON b.idband = bo.band_idband WHERE bo.optreden_idoptreden = $idEvent";
            $resultBands = $pdo->query($sqlBands);

            $bands = $resultBands->fetchAll(PDO::FETCH_ASSOC); // Store bands in an array

            if(count($bands) > 0) {
                echo "<div>";
                echo "<p>Artiesten</p>";
                echo "<ul>";
                foreach ($bands as $bandRow) {
                    echo "<li>".$bandRow["bandnaam"]."</li>";
                }
                echo "</ul>";
                echo "</div>";
                
                echo "<div>";
                echo "<p>Genre</p>";
                echo "<ul>";
                foreach ($bands as $bandRow) {
                    echo "<li>".$bandRow["muziekgenre"]."</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<p>No bands scheduled for this event</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No data found</p>";
}
?>
</div>