<?php

session_start();

require_once "db.php";
require_once "send_otp_mail.php";

// ===============================
// Check Verification Session
// ===============================

if (!isset($_SESSION['verify_email'])) {

    die("Session Expired.");

}

$email = $_SESSION['verify_email'];
