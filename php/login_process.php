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

$password = trim($_POST['password']);


// ===============================
// Check Email
// ===============================

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {

    die("Email not registered.");

}


// ===============================
// Fetch User Data
// ===============================

$user = mysqli_fetch_assoc($result);


// ===============================
// Verify Password
// ===============================

if (!password_verify($password, $user['password'])) {

    die("Incorrect Password.");

}


// ===============================
// Login Success
// ===============================

$_SESSION['user_id'] = $user['id'];

$_SESSION['first_name'] = $user['first_name'];

$_SESSION['email'] = $user['email'];

// ===============================
// Redirect After Login
// ===============================

header("Location: ../index.php");
exit();



?>