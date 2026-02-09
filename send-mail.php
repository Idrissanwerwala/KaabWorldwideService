<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first = trim($_POST['mf-first-name'] ?? '');
    $last  = trim($_POST['mf-last-name'] ?? '');
    $email = trim($_POST['mf-email'] ?? '');
    $sub   = trim($_POST['mf-subject'] ?? '');
    $msg   = trim($_POST['mf-comment'] ?? '');

    if (!$first || !$last || !$email || !$sub || !$msg) {
        echo "All fields are required.";
        exit;
    }

    $to = "idrissawerwala@gmail.com"; // CHANGE THIS

    $subject = "Website Contact: $sub";

    $body = "
New message from website:

Name: $first $last
Email: $email
Subject: $sub

Message:
$msg
";

    $headers  = "From: Website Contact <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Failed to send message. Please try again later.";
    }
}
