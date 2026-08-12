<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/SMTP.php';
require '../vendor/phpmailer/Exception.php';

$smtpConfig = require '../config/smtp_config.php';


/**
 * Send StrideX OTP Email
 *
 * @param string $receiverName
 * @param string $receiverEmail
 * @param string $otp
 * @param string $purpose
 * @return bool
 */
function sendOTPEmail(
    string $receiverName,
    string $receiverEmail,
    string $otp,
    string $purpose = 'Email Verification'
): bool {

    global $smtpConfig;

    $mail = new PHPMailer(true);

    try {

        // ===============================
        // SMTP
        // ===============================

        $mail->isSMTP();

        $mail->Host       = $smtpConfig['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpConfig['username'];
        $mail->Password   = $smtpConfig['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtpConfig['port'];


        // ===============================
        // SENDER
        // ===============================

        $mail->setFrom(
            $smtpConfig['username'],
            'StrideX'
        );


        // ===============================
        // RECEIVER
        // ===============================

        $mail->addAddress(
            $receiverEmail,
            $receiverName
        );


        // ===============================
        // EMAIL SETTINGS
        // ===============================

        $mail->isHTML(true);

        $mail->CharSet = 'UTF-8';

        $mail->Subject = "StrideX - Your OTP for {$purpose}";


        // ===============================
        // EMAIL BODY
        // ===============================

        $mail->Body = "
        <!DOCTYPE html>

        <html>

        <head>

            <meta charset='UTF-8'>

        </head>

        <body style='
            margin:0;
            padding:0;
            background:#111111;
            font-family:Arial, Helvetica, sans-serif;
            color:#ffffff;
        '>

            <div style='
                max-width:600px;
                margin:40px auto;
                background:#1b1b1b;
                border-radius:18px;
                padding:35px;
                box-sizing:border-box;
            '>

                <div style='
                    text-align:center;
                    margin-bottom:30px;
                '>

                    <h1 style='
                        margin:0;
                        font-size:32px;
                        letter-spacing:2px;
                        color:#ffffff;
                    '>
                        STRIDEX
                    </h1>

                    <p style='
                        color:#999999;
                        margin-top:8px;
                        font-size:14px;
                    '>
                        Step into your style.
                    </p>

                </div>


                <h2 style='
                    color:#ffffff;
                    margin-bottom:10px;
                '>
                    Hi " . htmlspecialchars($receiverName) . " 👋
                </h2>


                <p style='
                    color:#cccccc;
                    line-height:1.6;
                '>

                    We received a request for
                    <strong style='color:#ffffff;'>
                        {$purpose}
                    </strong>
                    on your StrideX account.

                </p>


                <p style='
                    color:#cccccc;
                    line-height:1.6;
                '>

                    Your One-Time Password (OTP) is:

                </p>


                <div style='
                    text-align:center;
                    margin:30px 0;
                '>

                    <div style='
                        display:inline-block;
                        background:#242424;
                        border:1px solid #444444;
                        border-radius:14px;
                        padding:18px 35px;
                        font-size:32px;
                        font-weight:bold;
                        letter-spacing:8px;
                        color:#ffffff;
                    '>

                        {$otp}

                    </div>

                </div>


                <p style='
                    text-align:center;
                    color:#aaaaaa;
                    font-size:14px;
                '>

                    ⏱ This OTP will expire in
                    <strong style='color:#ffffff;'>
                        5 minutes
                    </strong>.

                </p>


                <div style='
                    margin-top:30px;
                    padding:18px;
                    background:#242424;
                    border-radius:12px;
                    color:#aaaaaa;
                    font-size:13px;
                    line-height:1.6;
                '>

                    <strong style='color:#ffffff;'>
                        Security Notice
                    </strong>

                    <br>

                    Never share this OTP with anyone.
                    StrideX support will never ask you for your OTP.

                </div>


                <p style='
                    margin-top:30px;
                    color:#777777;
                    font-size:12px;
                    text-align:center;
                '>

                    If you did not request this OTP,
                    you can safely ignore this email.

                </p>


                <div style='
                    margin-top:30px;
                    border-top:1px solid #333333;
                    padding-top:20px;
                    text-align:center;
                    color:#666666;
                    font-size:12px;
                '>

                    © " . date('Y') . " StrideX.
                    All rights reserved.

                </div>

            </div>

        </body>

        </html>
        ";


        // ===============================
        // PLAIN TEXT FALLBACK
        // ===============================

        $mail->AltBody =
            "Hi {$receiverName},\n\n" .
            "Your StrideX OTP for {$purpose} is: {$otp}\n\n" .
            "This OTP will expire in 5 minutes.\n\n" .
            "Never share this OTP with anyone.\n\n" .
            "If you did not request this OTP, you can safely ignore this email.";


        // ===============================
        // SEND
        // ===============================

        $mail->send();

        return true;


    } catch (Exception $e) {

        error_log(
            "StrideX OTP Email Error: " . $mail->ErrorInfo
        );

        return false;
    }
}