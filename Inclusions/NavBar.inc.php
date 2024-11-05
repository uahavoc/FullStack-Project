<?php
// Controleer of de user kip is
if (isset($_SESSION['user']['naam'])  == "kip") {
  // Als de gebruiker 'kip' is, toon dan het volgende menu
  echo "<ul>"; 
   echo "<li><a href='Home.php'>Home</a></li>";
   echo "<li><a href='Agenda.php'>Agenda</a></li>";
   echo "<li><a href='Admin.php'>Admin</a></li>";
   // Voegt een uitlog-link toe aan de rechterkant
   echo "<li style='float:right'><a class='active' href='Responses/uitloggen.php'>Uitloggen</a></li>";
   // laat zien wie is ingelogd
   echo "<li style='float:right'><a>Welkom, " . ($_SESSION['user']['naam']) . "</a></li>";
  echo "</ul>";
} else {
  // Als de gebruiker niet 'kip' is, toon dan het volgende menu
  echo "<ul>"; 
   echo "<li><a href='Home.php'>Home</a></li>";
   echo "<li><a href='Agenda.php'>Agenda</a></li>";
   // Voeg een inlog-link toe aan de rechterkant
   echo "<li style='float:right'><a class='active' href='Inloggen.php'>Inloggen</a></li>";
  echo "</ul>";
}