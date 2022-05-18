<?php

namespace App\Infrastructure\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use App\Domain\Adapter\Mailer;

final class MailTrap implements Mailer
{
    public const CHARSET = 'UTF-8';

    private $mail;
    private $subject;
    private $body;

    public function __construct(string $subject, string $body)
    {
        $this->mail = $this->setUp();
        $this->subject = $subject;
        $this->body = $body;
    }

    public function send(): void
    {
        $this->mail->Subject = $this->subject;
        $this->mail->Body = $this->body;
        $this->mail->send();
    }

    private function setUp(): PHPMailer
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAILTRAP_USERNAME'];
        $mail->Password = $_ENV['MAILTRAP_PASSWORD'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        //Recipients
        $mail->setFrom('tq-twitter@example.com', 'Mailer');
        $mail->addAddress('tq-user@example.com', 'Mr To');

        //Content
        $mail->CharSet = self::CHARSET;
        return $mail;
    }
}
