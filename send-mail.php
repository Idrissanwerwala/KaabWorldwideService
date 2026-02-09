<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first = trim($_POST['mf-first-name'] ?? '');
    $last  = trim($_POST['mf-last-name'] ?? '');
    $email = trim($_POST['mf-email'] ?? '');
    $sub   = trim($_POST['mf-subject'] ?? '');
    $msg   = trim($_POST['mf-comment'] ?? '');

    // Basic validation
    if (!$first || !$last || !$email || !$sub || !$msg) {
        header("Location: contact.html?error=1");
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'idrissawerwala@gmail.com';
        $mail->Password   = 'lffkneyohcxpjfwt'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Mail setup
        $mail->setFrom('idrissawerwala@gmail.com', 'Website Contact');
        $mail->addAddress('idrissawerwala@gmail.com');
        $mail->addReplyTo($email);

        $mail->isHTML(false);
        $mail->Subject = "Website Contact: $sub";
        $mail->Body = 
"Name: $first $last
Email: $email
Subject: $sub

Message:
$msg";

        $mail->send();

        // ✅ Redirect back (SUCCESS)
        header("Location: https://idrissanwerwala.github.io/KaabWorldwideService/contact.html?success=1");

        exit;

    } catch (Exception $e) {

        // ❌ Redirect back (ERROR)
        header("Location: https://idrissanwerwala.github.io/KaabWorldwideService/contact.html?error=1");
        exit;
    }
}