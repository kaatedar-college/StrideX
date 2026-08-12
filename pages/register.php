<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width,initial-scale=1">

<title>Register</title>

<link
rel="stylesheet"
href="../assets/css/register.css">

<link rel="stylesheet" href="../assets/css/country-select.css">

<script
    src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.7.1/dist/dotlottie-wc.js"
    type="module">
</script>

<script src="../assets/js/dotlottie.js" defer></script>

</head>

<body>

<!-- STRIDEX PRELOADER START -->
<div id="preloader" class="stridex-preloader">

    <?php include '../components/preloader.php'; ?>

</div>
<!-- STRIDEX PRELOADER END -->

<div class="container">

<div class="left">

<img
src="../assets/images/logo/logo.png"
class="logo">

<h1>Create Account</h1>

<p>

Join STRIDEX.

</p>

</div>

<div class="right">

<form action="../php/register_process.php" method="POST">

<h2 class="title">

Register

</h2>

<input
type="text"
name="first_name"
placeholder="First Name"
required>

<input
type="text"
name="last_name"
placeholder="Last Name"
required>

<input
type="email"
name="email"
placeholder="Email"
required>

<div class="phone-box">

    <div class="country-selector">

        <div class="selected-country">

            <img src="../assets/images/flags/in.svg" alt="India">

            <span>IN +91</span>

            <i class="arrow">&#9662;</i>

        </div>

        <div class="country-dropdown">

            <input
                type="text"
                class="country-search"
                placeholder="Search Country">

            <div class="country-list"></div>

        </div>

    </div>

    <input
    type="hidden"
    name="country_code"
    id="countryCode"
    value="+91">

    <input
    type="hidden"
    name="country_short"
    id="countryShort"
    value="IN">

    <input
        type="tel"
        name="phone"
        class="phone-input"
        placeholder="Phone Number"
        maxlength="10"
        required>

</div>
<div class="pass">

    <input
    type="password"
    id="password"
    name="password"
    placeholder="Password"
    required>

    <button
    type="button"
    class="toggle-password"
    onclick="togglePass('password', this)">

        👁

    </button>

</div>

<div class="pass">

    <input
    type="password"
    id="confirm_password"
    name="confirm_password"
    placeholder="Confirm Password"
    required>

    <button
    type="button"
    class="toggle-password"
    onclick="togglePass('confirm_password', this)">

        👁

    </button>

</div>

<button type="submit">

    CREATE ACCOUNT

</button>
<p class="login">

Already have account?

<a href="login.php">

Login

</a>

</p>

</form>

</div>

</div>

<script src="../assets/data/countries.js"></script>
<script src="../assets/js/register.js"></script>
<script src="../assets/js/country-select.js"></script>
<script src="../assets/js/login.js"></script>
</body>

</html>