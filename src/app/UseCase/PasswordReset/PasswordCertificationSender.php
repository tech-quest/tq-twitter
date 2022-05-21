<?php

namespace App\UseCase\PasswordReset;

use App\Infrastructure\Mail\MailTrap;

final class PasswordCertificationSender
{
    public const SUBJECT = 'パスワードをリセットしますか？';
    public const BODY_TEMPLATE = <<<EOF
  ご利用のTwitterアカウント「%s」のパスワードをリセットするには、以下の認証コードを使ってプロセスを完了してください。パスワードのリセットにお心当たりがない場合はこのメールを無視してください。
  
  認証コード : %s

EOF;
    // TODO: Userエンティティで受け取る
    private $user;

    // TODO: ValueObjectで受け取る
    private $certificationCode;

    public function __construct(array $user, string $certificationCode)
    {
        $this->user = $user;
        $this->certificationCode = $certificationCode;
    }

    public function send(): void
    {
        $body = sprintf(
            self::BODY_TEMPLATE,
            $this->user['name'],
            $this->certificationCode
        );
        $mail = new MailTrap(self::SUBJECT, $body);
        $mail->send();
    }
}
