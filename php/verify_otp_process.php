<?php

// ===============================
// Check Session & Get User Data
// ===============================

session_start();

require 'db.php';

if (!isset($_SESSION['verify_email'])) {

    header("Location: ../pages/register.php");
    exit();

}

$email = $_SESSION['verify_email'];

$otp = trim($_POST['otp']);

// ===============================
// Get User From Database
// ===============================

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);


// ===============================
// Check User Exists
// ===============================

if (!$user) {

    die("User not found.");

}

// ===============================
// Check Already Verified
// ===============================

if (
    !isset($_SESSION['otp_type']) ||
    $_SESSION['otp_type'] != "forgot"
) {

    if ($user['is_verified'] == 1) {

        die("Email already verified.");

    }

}

// ===============================
// Check OTP Expiry
// ===============================

$current_time = date("Y-m-d H:i:s");

if ($current_time > $user['otp_expire']) {

    $_SESSION['otp_error'] = "OTP Expired";

header("Location: ../pages/verify_otp.php");

exit();

}

// ===============================
// Verify OTP
// ===============================

if ($otp != $user['otp']) {

    $_SESSION['otp_error'] = "Invalid OTP";

header("Location: ../pages/verify_otp.php");

exit();

}

// ===============================
// Forgot Password Flow
// ===============================

if (isset($_SESSION['otp_type']) && $_SESSION['otp_type'] == "forgot") {

    header("Location: ../pages/reset_password.php");

    exit();

}

// ===============================
// Update User Verification Status
// ===============================

$sql = "UPDATE users
SET
is_verified = 1,
otp = NULL,
otp_expire = NULL
WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

// ===============================
// Clear Verification Session
// ===============================

unset($_SESSION['verify_email']);
unset($_SESSION['otp_type']);
// ===============================
// Redirect To Login Page
// ===============================

header("Location: ../pages/login.php?verified=1");

exit();