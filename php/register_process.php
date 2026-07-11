<?php

// Database Connection

require_once "db.php";


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


// ===============================
// Password Hash
// ===============================

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// ===============================
// Insert User
// ===============================

$sql = "INSERT INTO users
(first_name, last_name, email, country_code, country_short, phone, password)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssssss",
    $first_name,
    $last_name,
    $email,
    $country_code,
    $country_short,
    $phone,
    $hashed_password
);

if (mysqli_stmt_execute($stmt)) {

    echo "Registration Successful.";

} else {

    die("Registration Failed.");

}

?>