<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/SMTP.php';
require '../vendor/phpmailer/Exception.php';

$mail = new PHPMailer(true);

try {

    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    // Tumhara Gmail
    $mail->Username   = 'stridex.team@gmail.com';

    // Yahan Gmail App Password paste karna
    $mail->Password   = 'kllm vbvu zvkd fhgi';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender
    $mail->setFrom('stridex.team@gmail.com', 'StrideX');

    // Receiver
    $mail->addAddress('kp321407@gmail.com');

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = 'Hello from StrideX';
    $mail->Body    = '<h2>🎉 PHPMailer Working Successfully!</h2>
                      <p>Congratulations Bro! Tumhara StrideX Mail System ka first test successful hai.</p>';

    $mail->send();

    echo "Email Sent Successfully.";

} catch (Exception $e) {

    echo "Email Failed: {$mail->ErrorInfo}";
}