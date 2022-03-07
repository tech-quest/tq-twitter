<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'e2c8d375a4ef64';
    $mail->Password = 'b11c6ac43b6b7e';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    //Recipients
    $mail->setFrom('tq-twitter@example.com', 'Mailer');
    $mail->addAddress('tq-user@example.com', 'Mr To');

    //Content
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'メールのタイトル';
    $mail->Body = 'メールの本文';

    //送信
    $mail->send();

    echo 'send';
} catch (Exception $e) {
    echo 'error:' . $mail->ErrorInfo;
}
