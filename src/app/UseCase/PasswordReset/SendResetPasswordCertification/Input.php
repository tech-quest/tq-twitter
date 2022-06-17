<?php

namespace App\UseCase\PasswordReset\SendResetPasswordCertification;

use App\Domain\ValueObject\Email;

final class Input
{
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function email()
    {
        return $this->email;
    }
}
