<?php

session_start();

// Direct Access Block
if (!isset($_SESSION['verify_email']) ||
    !isset($_SESSION['otp_type']) ||
    $_SESSION['otp_type'] != "forgot") {

    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Reset Password</title>

<link rel="stylesheet"
href="../assets/css/login.css">

</head>

<body>

<div class="container">

<div class="left">

<img src="../assets/images/logo/logo.png"
class="logo">

<h1>Create New Password</h1>

<p>Your new password must be secure.</p>

</div>

<div class="right">

<form
action="../php/reset_password_process.php"
method="POST">

<h2>Reset Password</h2>

<div class="password">

    <input
    type="password"
    id="password"
    name="password"
    placeholder="New Password"
    required>

    <button
    type="button"
    onclick="togglePass('password', this)">

        👁

    </button>

</div>

<div class="password">

    <input
    type="password"
    id="confirm_password"
    name="confirm_password"
    placeholder="Confirm Password"
    required>

    <button
    type="button"
    onclick="togglePass('confirm_password', this)">

        👁

    </button>

</div>

<button
type="submit"
class="login">

Update Password

</button>

</form>

</div>

</div>

<script src="../assets/js/login.js"></script>

</body>

</html>
