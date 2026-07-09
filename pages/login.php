<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<form>

<h2>Login</h2>

<input
type="email"
placeholder="Email"
required
>

<div class="password">

<input
type="password"
id="password"
placeholder="Password"
required>

<button
type="button"
onclick="togglePass()">

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

<button class="login">
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