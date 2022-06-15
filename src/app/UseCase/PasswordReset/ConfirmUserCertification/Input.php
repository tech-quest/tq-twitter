<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\Domain\ValueObject\Email;

final class Input
{
    private Email $email;
    private string $certificationCode;

    public function __construct(Email $email, string $certificationCode)
    {
        $this->email = $email;
        $this->certificationCode = $certificationCode;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function certificationCode(): string
    {
        return $this->certificationCode;
    }
}
