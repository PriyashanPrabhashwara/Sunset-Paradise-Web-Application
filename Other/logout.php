<?php
session_start(); // Start the session

// Destroy all session data
session_unset();   // Unset all session variables
session_destroy(); // Destroy the session itself

// Redirect to the login page or home page after logout
header("Location: home.php");
exit();
?>