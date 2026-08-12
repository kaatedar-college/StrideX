<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/SMTP.php';
require '../vendor/phpmailer/Exception.php';

// ===============================
// SMTP Configuration
// ===============================

$smtpConfig = require '../config/smtp_config.php';


// ===============================
// Send OTP Email
// ===============================

function sendOTP($receiverEmail, $receiverName, $otp)
{
    global $smtpConfig;

    $mail = new PHPMailer(true);

    try {

        // ===============================
        // SMTP Settings
        // ===============================

        $mail->isSMTP();

        $mail->Host       = $smtpConfig['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpConfig['username'];
        $mail->Password   = $smtpConfig['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtpConfig['port'];


        // ===============================
        // Sender
        // ===============================

        $mail->setFrom(
            $smtpConfig['username'],
            'StrideX'
        );


        // ===============================
        // Receiver
        // ===============================

        $mail->addAddress(
            $receiverEmail,
            $receiverName
        );


        // ===============================
        // Email
        // ===============================

        $mail->isHTML(true);

        $mail->CharSet = 'UTF-8';

        $mail->Subject = 'StrideX - Email Verification OTP';


        // ===============================
        // Safe Output
        // ===============================

        $safeName = htmlspecialchars(
            $receiverName,
            ENT_QUOTES,
            'UTF-8'
        );

        $safeOTP = htmlspecialchars(
            $otp,
            ENT_QUOTES,
            'UTF-8'
        );


        // ===============================
        // Email Body
        // ===============================

        $mail->Body = "

        <div style='
            max-width:600px;
            margin:auto;
            padding:30px;
            background:#171717;
            color:#ffffff;
            font-family:Arial, sans-serif;
            border-radius:18px;
        '>

            <h1 style='
                text-align:center;
                letter-spacing:3px;
            '>
                STRIDEX
            </h1>

            <p>
                Hello <strong>{$safeName}</strong> 👋
            </p>

            <p>
                Welcome to StrideX.
                Please use the OTP below to verify your email address.
            </p>

            <div style='
                text-align:center;
                margin:30px 0;
            '>

                <span style='
                    display:inline-block;
                    padding:18px 30px;
                    background:#242424;
                    border-radius:12px;
                    font-size:32px;
                    font-weight:bold;
                    letter-spacing:8px;
                '>

                    {$safeOTP}

                </span>

            </div>

            <p style='text-align:center;color:#aaaaaa;'>

                ⏱️ This OTP will expire in
                <strong style='color:#ffffff;'>
                    5 minutes
                </strong>.

            </p>

            <div style='
                margin-top:25px;
                padding:15px;
                background:#202020;
                border-radius:10px;
                color:#aaaaaa;
                font-size:13px;
            '>

                🔐 Never share this OTP with anyone.
                StrideX will never ask you for your OTP.

            </div>

            <p style='
                text-align:center;
                color:#666666;
                font-size:12px;
                margin-top:30px;
            '>

                If you did not request this email,
                you can safely ignore it.

            </p>

            <hr style='border:0;border-top:1px solid #333333;'>

            <p style='
                text-align:center;
                color:#666666;
                font-size:12px;
            '>

                © " . date('Y') . " StrideX

            </p>

        </div>

        ";


        // ===============================
        // Plain Text Version
        // ===============================

        $mail->AltBody =
            "Hello {$receiverName},\n\n" .
            "Your StrideX email verification OTP is: {$otp}\n\n" .
            "This OTP will expire in 5 minutes.\n\n" .
            "Never share this OTP with anyone.\n\n" .
            "If you did not request this email, you can safely ignore it.";


        // ===============================
        // Send
        // ===============================

        $mail->send();

        return true;


    } catch (Exception $e) {

        error_log(
            "StrideX OTP Email Error: " .
            $mail->ErrorInfo
        );

        return false;
    }
}

?>