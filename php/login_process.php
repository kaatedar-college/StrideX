<?php

session_start();

// ===============================
// Database Connection
// ===============================

require_once "db.php";


// ===============================
// Check Request Method
// ===============================

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../pages/login.php");
    exit();

}


// ===============================
// Get Form Data
// ===============================

$email = trim($_POST['email']);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die("Invalid Email.");

} 

$password = trim($_POST['password']);

// ===============================
// Empty Field Validation
// ===============================

if (empty($email) || empty($password)) {

    $_SESSION['login_error'] = "All fields are required.";

    header("Location: ../pages/login.php");

    exit();

}

// ===============================
// Email Validation
// ===============================

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['login_error'] = "Invalid email address.";

    header("Location: ../pages/login.php");

    exit();

}


// ===============================
// Check Email
// ===============================

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {

$_SESSION['login_error'] = "Email not registered.";

header("Location: ../pages/login.php");

exit();

}


// ===============================
// Fetch User Data
// ===============================

$user = mysqli_fetch_assoc($result);


// ===============================
// Verify Password
// ===============================

if (!password_verify($password, $user['password'])) {

    $_SESSION['login_error'] = "Incorrect Password.";

header("Location: ../pages/login.php");

exit();

}

// ===============================
// Check Email Verification
// ===============================

if ($user['is_verified'] == 0) {

    $_SESSION['login_error'] = "Please verify your email first.";

    header("Location: ../pages/login.php");

    exit();

}

// ===============================
// Secure Session
// ===============================

session_regenerate_id(true);

// ===============================
// Session Security
// ===============================

$_SESSION['user_id'] = $user['id'];

$_SESSION['first_name'] = $user['first_name'];

$_SESSION['email'] = $user['email'];

$_SESSION['login_time'] = time();

// ===============================
// Check Email Verification
// ===============================

if ($user['is_verified'] == 0) {

    die("Please verify your email first.");

}


// ===============================
// Redirect After Login
// ===============================

header("Location: ../index.php");
exit();



?>