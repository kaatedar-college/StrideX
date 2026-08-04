<?php

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


// Remove all session data
session_unset();

// Destroy session
session_destroy();

$_SESSION = []; 

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to Login Page
header("Location: ../pages/login.php");
exit();

?>