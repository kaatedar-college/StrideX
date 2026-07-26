<?php

// Database Connection

session_start();

require_once "db.php";
require_once "cleanup_unverified.php";
require 'send_otp_mail.php';

// Check Form Submit

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../pages/register.php");
    exit();

}


// ===============================
// Get Form Data
// ===============================

$first_name = trim($_POST['first_name']);

$last_name = trim($_POST['last_name']);

$email = trim($_POST['email']);

$country_code = trim($_POST['country_code']);

$country_short = trim($_POST['country_short']);

$phone = trim($_POST['phone']);

$password = trim($_POST['password']);

$confirm_password = trim($_POST['confirm_password']);


// ===============================
// Empty Validation
// ===============================

if (

    empty($first_name) ||

    empty($last_name) ||

    empty($email) ||

    empty($country_code) ||

    empty($country_short) ||

    empty($phone) ||

    empty($password) ||

    empty($confirm_password)

) {

    die("Please fill all fields.");

}


// ===============================
// Email Validation
// ===============================

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die("Invalid Email Address.");

}


// ===============================
// Phone Validation
// ===============================

if (!preg_match('/^[0-9]{8,15}$/', $phone)) {

    die("Invalid Phone Number.");

}


// ===============================
// Password Match
// ===============================

if ($password !== $confirm_password) {

    die("Passwords do not match.");

}

// Generate OTP
$otp = random_int(100000, 999999);

// OTP Expiry (5 minutes)
$otp_expire = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// User not verified yet
$is_verified = 0;

// ===============================
// Check Duplicate Email
// ===============================

$sql = "SELECT id FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {

    die("Email already registered.");

}

mysqli_stmt_close($stmt);

// ===============================
// Password Hash
// ===============================

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// ===============================
// Insert User
// ===============================

$sql = "INSERT INTO users
(first_name, last_name, email, country_code, country_short, phone, password, otp, otp_expire, is_verified)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssssssssi",
    $first_name,
    $last_name,
    $email,
    $country_code,
    $country_short,
    $phone,
    $hashed_password,
    $otp,
    $otp_expire,
    $is_verified
);

if (mysqli_stmt_execute($stmt)) {

    if (sendOTP($email, $first_name, $otp)) {

        $_SESSION['verify_email'] = $email;

        header("Location: ../pages/verify_otp.php");

        exit();

    } else {

        die("OTP Email Failed.");

    }

} else {

    die("Registration Failed.");

}

?>