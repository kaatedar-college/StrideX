<?php

session_start();

// ===============================
// Database Connection
// ===============================

require_once "db.php";
require_once "send_otp_mail.php";

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
$_SESSION['old_email'] = $email;
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

    // New OTP
    $newOTP = rand(100000, 999999);

    // OTP Expiry (5 Minutes)
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    // Update OTP in Database
    $updateSql = "UPDATE users
                  SET otp = ?, otp_expire = ?
                  WHERE email = ?";

    $updateStmt = mysqli_prepare($conn, $updateSql);

    mysqli_stmt_bind_param(
        $updateStmt,
        "sss",
        $newOTP,
        $expiry,
        $user['email']
    );

    mysqli_stmt_execute($updateStmt);

    mysqli_stmt_close($updateStmt);

    // Send OTP Email
    if (sendOTP($user['email'], $user['first_name'], $newOTP)) {

        $_SESSION['verify_email'] = $user['email'];

        header("Location: ../pages/verify_otp.php");

        exit();

    } else {

        $_SESSION['login_error'] = "Failed to send OTP. Please try again.";

        header("Location: ../pages/login.php");

        exit();

    }

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
// Redirect After Login
// ===============================
unset($_SESSION['old_email']);
header("Location: ../index.php");
exit();



?>