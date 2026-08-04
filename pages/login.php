<?php

session_start();

$hasLoginError = isset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<title>STRIDEX Login</title>

<link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

<div class="container">

<div class="left">
<img src="../assets/images/logo/logo.png" class="logo">

<h1>WELCOME BACK</h1>

<p>Sign in and explore premium sneakers.</p>
</div>

<div class="right">

<form action="../php/login_process.php" method="POST">

<h2>Login</h2>

<?php if(isset($_SESSION['login_error'])) { ?>

<div class="login-error">

    <div class="login-error-icon">

        <i class="fa-solid fa-circle-exclamation"></i>

    </div>

    <span class="login-error-text">

        <?php

            echo $_SESSION['login_error'];

            unset($_SESSION['login_error']);

        ?>

    </span>

</div>

<?php } ?>

<input
type="email"
placeholder="Email"
name="email"
value="<?php echo isset($_SESSION['old_email']) ? htmlspecialchars($_SESSION['old_email']) : ''; ?>"
required
>

<div class="password">

    <input
    type="password"
    id="password"
    name="password"
    placeholder="Password"
    required>

    <button
    type="button"
    onclick="togglePass('password', this)">

        👁

    </button>

</div>


<div class="options">

<label class="check-container">

<input type="checkbox">

<span class="checkmark"></span>

Remember me

</label>

</div>

<button type="submit" class="login">
LOGIN
</button>

<p class="forgot">

<a href="forgot_password.php">

Forgot Password?

</a>

</p>

<p class="register">

No account?

<a href="register.php">
Create
</a>

</p>

</p>

</form>

</div>

</div>

<script src="../assets/js/login.js"></script>

</body>
</html>