<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width,initial-scale=1">

<link
rel="stylesheet"
href="../assets/css/forgot.css">

<title>Forgot Password</title>

</head>

<body>

<div class="box">

<h1>

Forgot Password

</h1>

<p>

Enter your email

</p>

<form action="../php/forgot_process.php" method="POST">

<input
type="email"
name="email"
placeholder="Enter your email"
required>

<button>

RESET PASSWORD

</button>

</form>

<a
class="back"
href="login.php">

Back to Login

</a>

</div>

</body>

</html>