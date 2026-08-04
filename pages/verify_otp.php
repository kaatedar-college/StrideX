<?php

session_start();

$title = "Email Verification";
$subtitle = "Enter the OTP sent to your email.";

if (
    isset($_SESSION['otp_type']) &&
    $_SESSION['otp_type'] == "forgot"
) {

    $title = "Forgot Password";
    $subtitle = "Enter the OTP to reset your password.";

}

$hasError = isset($_SESSION['otp_error']);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify OTP | StrideX</title>

    <link rel="stylesheet" href="../assets/css/verify_otp.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body class="<?php echo isset($_SESSION['otp_error']) ? 'no-animation' : ''; ?>">

    <div class="verify-container">

        <div class="verify-card">

            <!-- Logo -->

            <img src="../assets/images/logo/logo.png"
                 alt="StrideX Logo"
                 class="logo">

            <!-- Heading -->

            <h1>Verify Yor Email</h1>u

            <!-- Subtitle -->

            <p class="subtitle">

                We've sent a verification code to

            </p>

            <!-- Email -->

         <p class="email">

<?php

if (!empty($email)) {

    $parts = explode("@", $email);

    $name = substr($parts[0], 0, 3);

    echo $name . "****@" . $parts[1];

}

?>

</p>

<?php if(isset($_SESSION['otp_error'])) { ?>

<div class="otp-error" id="otpError">

    <div class="otp-error-icon">

        <i class="fa-solid fa-circle-exclamation"></i>

    </div>

    <span class="otp-error-text">

        <?php

            echo $_SESSION['otp_error'];

            unset($_SESSION['otp_error']);

        ?>

    </span>

</div>

<?php } ?>

</p>

            <!-- OTP Form -->

            <form action="../php/verify_otp_process.php"
                  method="POST"
                  id="otpForm">

                <div class="otp-boxes <?php echo $hasError ? 'otp-invalid' : ''; ?>">

                    <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">

                </div>

                <input type="hidden" name="otp" id="finalOTP">

                <button type="submit"
                        class="verify-btn">

                    Verify OTP

                </button>

            </form>

            <!-- Resend -->

            <p class="resend-text">

    Resend OTP in
    <span id="countdown">60</span>s

</p>

<a href="#" id="resendLink" style="display:none;">

    Resend OTP

</a>
            <!-- Back -->

            <a href="login.php"
               class="back-login">

                ← Back to Login

            </a>

        </div>

    </div>
    
    <script src="../assets/js/verify_otp.js"></script>

</body>

</html>
<?php

$title = "Email Verification";
$subtitle = "Enter the OTP sent to your email.";

if (
    isset($_SESSION['otp_type']) &&
    $_SESSION['otp_type'] == "forgot"
) {

    $title = "Forgot Password";
    $subtitle = "Enter the OTP to reset your password.";

}

?>
