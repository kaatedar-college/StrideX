<?php

session_start();

require_once "db.php";

// ===============================
// Check Session
// ===============================

if (
    !isset($_SESSION['verify_email']) ||
    !isset($_SESSION['otp_type']) ||
    $_SESSION['otp_type'] != "forgot"
) {

    header("Location: ../pages/login.php");
    exit();

}

$email = $_SESSION['verify_email'];

// ===============================
// Get Form Data
// ===============================

$password = trim($_POST['password']);
$confirmPassword = trim($_POST['confirm_password']);

// ===============================
// Empty Check
// ===============================

if (empty($password) || empty($confirmPassword)) {

    die("All fields are required.");

}

// ===============================
// Password Match
// ===============================

if ($password !== $confirmPassword) {

    die("Passwords do not match.");

}

// ===============================
// Password Hash
// ===============================

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ===============================
// Update Password
// ===============================

$sql = "UPDATE users
SET
password = ?,
otp = NULL,
otp_expire = NULL
WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $hashedPassword,
    $email
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

// ===============================
// Clear Session
// ===============================

unset($_SESSION['verify_email']);
unset($_SESSION['otp_type']);

// ===============================
// Redirect
// ===============================

header("Location: ../pages/login.php?reset=success");
exit();

?>