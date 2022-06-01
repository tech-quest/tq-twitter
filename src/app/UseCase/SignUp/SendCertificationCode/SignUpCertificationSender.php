<?php

namespace App\UseCase\SignUp\SendCertificationCode;

use App\Infrastructure\Mail\MailTrap;
use App\Domain\ValueObject\SignUpCertificationCode;

final class SignUpCertificationSender
{
    public const SUBJECT = 'アカウント認証';
    public const BODY_TEMPLATE = <<<EOF
  以下の認証コードを使ってプロセスを完了してください。
  アカウントの作成にお心当たりがない場合はこのメールを無視してください。
  
  認証コード : %s

EOF;

    // TODO: ValueObjectで受け取る
    private $certificationCode;

    public function __construct(string $certificationCode)
    {
        $this->certificationCode = $certificationCode;
    }

    public function send(): void
    {
        $body = sprintf(self::BODY_TEMPLATE, $this->certificationCode);
        $mail = new MailTrap(self::SUBJECT, $body);
        $mail->send();
    }
}
