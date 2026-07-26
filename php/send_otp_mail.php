<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/SMTP.php';
require '../vendor/phpmailer/Exception.php';

function sendOTP($receiverEmail, $receiverName, $otp)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // Gmail
        $mail->Username = 'stridex.team@gmail.com';

        // App Password
        $mail->Password = 'kllm vbvu zvkd fhgi';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender
        $mail->setFrom('stridex.team@gmail.com', 'StrideX');

        // Receiver
        $mail->addAddress($receiverEmail, $receiverName);

        $mail->isHTML(true);

        $mail->Subject = "StrideX Email Verification OTP";

        $mail->Body = "
        <h2>Welcome to StrideX</h2>

        <p>Hello <b>$receiverName</b>,</p>

        <p>Your verification OTP is:</p>

        <h1>$otp</h1>

        <p>This OTP will expire in <b>5 minutes</b>.</p>

        <p>If you didn't request this email, please ignore it.</p>

        <hr>

        <small>StrideX Team</small>
        ";

        $mail->send();

        return true;

    } catch (Exception $e) {

        return false;

    }
}