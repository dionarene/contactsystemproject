

<?php 
// Unset all of the session variables
session_start();
$_SESSION["email"] = "";

// Destroy the session.
session_destroy();
header("Location: login.php");