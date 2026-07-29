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

// ===============================
// Generate New OTP
// ===============================

$newOTP = rand(100000, 999999);

$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// ===============================
// Update OTP in Database
// ===============================

$sql = "UPDATE users
        SET otp = ?, otp_expire = ?
        WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sss",
    $newOTP,
    $expiry,
    $email
);

if(!mysqli_stmt_execute($stmt)){

    die("Database Error.");

}

// ===============================
// Get User Name
// ===============================

$sql = "SELECT first_name FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

$receiverName = $user['first_name'];

// ===============================
// Send New OTP Email
// ===============================

if(sendOTP($email, $receiverName, $newOTP)){

    echo "success";

}else{

    echo "mail_error";

}
