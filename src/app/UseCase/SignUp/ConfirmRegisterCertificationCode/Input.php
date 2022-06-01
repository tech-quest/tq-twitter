<?php

namespace App\UseCase\SignUp\ConfirmRegisterCertificationCode;

use App\Domain\ValueObject\Email;

final class Input
{
    private string $code;
    private Email $email;

    public function __construct(string $code, Email $email)
    {
        $this->code = $code;
        $this->email = $email;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
