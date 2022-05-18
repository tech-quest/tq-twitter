<?php

namespace App\UseCase\SignUp\SendUserRegisterCertificationCode;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;

final class Input
{
    private Name $name;
    private Email $email;

    public function __construct(Name $name, Email $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
