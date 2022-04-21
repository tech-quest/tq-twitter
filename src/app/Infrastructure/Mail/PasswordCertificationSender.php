<?php

namespace App\Infrastructure\Mail;

use PHPMailer\PHPMailer\PHPMailer;

final class PasswordCertificationSender
{
    public const CHARSET = 'UTF-8';
    public const SUBJECT = 'パスワードをリセットしますか？';
    public const BODY = <<<EOF
  ご利用のTwitterアカウント「%s」のパスワードをリセットするには、以下の認証コードを使ってプロセスを完了してください。パスワードのリセットにお心当たりがない場合はこのメールを無視してください。
  
  認証コード : %s

EOF;

    private $user;
    private $certificationCode;

    public function __construct(array $user, string $certificationCode)
    {
        $this->user = $user;
        $this->certificationCode = $certificationCode;
    }

    public function sendMail(): void
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;
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
        $mail->Subject = self::SUBJECT;
        $mail->Body = sprintf(
            self::BODY,
            $this->user['name'],
            $this->certificationCode
        );
        //送信
        $mail->send();
    }
}
