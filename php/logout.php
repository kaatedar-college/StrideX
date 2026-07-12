<?php

session_start();

// Remove all session data
session_unset();

// Destroy session
session_destroy();

// Redirect to Login Page
header("Location: ../pages/login.php");
exit();

?>