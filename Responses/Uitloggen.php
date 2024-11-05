<?php
session_start(); 

if (isset($_SESSION["user"])) { //checks if user is logged in
    
    $_SESSION = array(); //logs user out
    session_destroy();
    //sends you to back home
header('Location: ../home.php'); 
// Beëindig het script
    exit();
}