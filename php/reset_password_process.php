<?php

session_start();

require_once "db.php";

// ===============================
// Check successful OTP verification session
// ===============================

$resetVerification = $_SESSION['password_reset_verification'] ?? null;

if (!is_array($resetVerification) ||
    empty($resetVerification['user_id']) ||
    empty($resetVerification['email']) ||
    empty($resetVerification['expires_at']) ||
    time() > $resetVerification['expires_at']) {

    unset($_SESSION['password_reset_verification']);

    header("Location: ../pages/login.php");
    exit();

}

$userId = (int) $resetVerification['user_id'];
$email = $resetVerification['email'];

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
WHERE id = ? AND email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sis",
    $hashedPassword,
    $userId,
    $email
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

// ===============================
// Clear Session
// ===============================

unset($_SESSION['password_reset_verification']);

// ===============================
// Redirect
// ===============================

header("Location: ../pages/login.php?reset=success");
exit();

?>
