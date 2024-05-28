<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="CSS.css" /> 
  <title>CasusCafe</title>
</head>
<body>

<header class="header">  
  <!-- navigation bar  -->
    <ul> 
      <li><a href="Home.php">Home</a></li> 
      <li><a href="Agenda.php">Agenda</a></li> 
      <li><a href="Admin.php">Admin</a></li> 
      <li style="float:right"><a class="active" href="Inloggen.php">Inloggen</a></li>
    </ul> 
</header>

<main>

<div>
<form class = inlogzooi action="./InloggenRespondPage.php" method="POST">
		Email: <br> <input type="text" name="email" value=""> <br>
    Wachtwoord: <br> <input type="password" name="wachtwoord" value="">
		<input type="submit" name="knop" value="verstuur">
	</form>
</div>




</main>

<footer> 
  <p>&copy; CasusCafe 2024</p> 
</footer> 

</body>
</html>