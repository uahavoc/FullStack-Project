<?php
session_start(); // Start de sessie
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="Style/CSS.css" /> 
  <title>CasusCafe</title>
  <link rel="icon" type="image/x-icon" href="Images/favicon.ico">
</head>
<body>

<style>
    /* de achtergrondafbeelding */
    body {
        overflow-x: hidden;
        background-image: url("Images/MusicNotes.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<header class="header">  
  <!-- Navigatiebalk invoegen -->
    <?php require_once 'Inclusions/NavBar.inc.php' ?>
</header>

<main>
  <!-- Inlogformulier -->
  <div class="inlog">
    <form class="inlogzooi" action="Responses/InloggenRespondPage.php" method="POST">
      <!-- email -->
      Email: <br> <input type="text" name="email" value=""> <br>
     <!-- error als je het niet heb ingevuld -->
      <?php if (isset($_SESSION['error'])) { ?>
    <p class="error"><?php echo $_SESSION['error']; ?></p>
  <?php 
    $_SESSION['error'] = '';
} ?>

      <!-- wacht woord. -->
      Wachtwoord: <br> <input type="password" name="wachtwoord" value="">
      <input type="submit" name="knop" value="verstuur">
      <!-- error als je het niet heb ingevuld -->
      <?php if (isset($_SESSION['error'])) { ?>
    <p class="error"><?php echo $_SESSION['error']; ?></p>
  <?php 
    $_SESSION['error'] = '';
} ?>
    </form>
    
  </div>
  
</main>

<footer>
  <p>&copy; CasusCafe 2024</p>
</footer>

</body>
</html>