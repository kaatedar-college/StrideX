<?php

session_start();

require_once "db.php";
require_once "send_otp_mail.php";

// ===============================
// Check Request
// ===============================

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../pages/login.php");
    exit();

}

// A new reset request invalidates any previously verified reset session.
unset($_SESSION['password_reset_verification']);

// ===============================
// Get Email
// ===============================

$email = trim($_POST["email"]);

// ===============================
// Check Empty
// ===============================

if (empty($email)) {

    $_SESSION['forgot_error'] = "Please enter your email.";

    header("Location: ../pages/login.php");

    exit();

}

// ===============================
// Check User
// ===============================

$sql = "SELECT first_name,email FROM users WHERE email=?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"s",$email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0){

    $_SESSION['forgot_error']="Email not registered.";

    header("Location: ../pages/login.php");

    exit();

}

$user=mysqli_fetch_assoc($result);

// ===============================
// Generate OTP
// ===============================

$otp = rand(100000,999999);

$expiry = date("Y-m-d H:i:s",strtotime("+5 minutes"));

// ===============================
// Save OTP
// ===============================

$update = "UPDATE users
SET otp=?,
otp_expire=?
WHERE email=?";

$stmt=mysqli_prepare($conn,$update);

mysqli_stmt_bind_param(
$stmt,
"sss",
$otp,
$expiry,
$email
);

mysqli_stmt_execute($stmt);

// ===============================
// Send OTP
// ===============================

if(sendOTP($email,$user['first_name'],$otp)){

    $_SESSION['verify_email']=$email;

    $_SESSION['otp_type']="forgot";

    header("Location: ../pages/verify_otp.php");

    exit();

}else{

    $_SESSION['forgot_error']="Unable to send OTP.";

    header("Location: ../pages/login.php");

    exit();

}

?>
