<?php

namespace App\UseCase\PasswordReset;

use App\Infrastructure\Mail\MailTrap;
use App\Domain\Entity\User;
use App\Domain\Entity\PasswordResetCertificationOnSave;

final class PasswordCertificationSender
{
    public const SUBJECT = 'パスワードをリセットしますか？';
    public const BODY_TEMPLATE = <<<EOF
  ご利用のTwitterアカウント「%s」のパスワードをリセットするには、以下の認証コードを使ってプロセスを完了してください。パスワードのリセットにお心当たりがない場合はこのメールを無視してください。
  
  認証コード : %s

EOF;
    private User $user;
    private PasswordResetCertificationOnSave $certification;

    public function __construct(User $user, PasswordResetCertificationOnSave $certification)
    {
        $this->user = $user;
        $this->certificationCode = $certification;
    }

    public function send(): void
    {
        $body = sprintf(
            self::BODY_TEMPLATE,
            $this->user->name()->value(),
            $this->certification->code()->value(),
        );
        $mail = new MailTrap(self::SUBJECT, $body);
        $mail->send();
    }
}
