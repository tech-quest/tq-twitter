<?php

namespace App\UseCase\SignUp\CompleteUserRegister;

use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;

final class Input
{
    private string $password;

    private string $hashCertificateRegisterCode;

    private Name $name;

    private Email $email;

    public function __construct(
        string $password,
        string $hashCertificateRegisterCode,
        Name $name,
        Email $email
    ) {
        $this->password = $password;
        $this->hashCertificateRegisterCode = $hashCertificateRegisterCode;
        $this->name = $name;
        $this->email = $email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function hashCertificateRegisterCode(): string
    {
        return $this->hashCertificateRegisterCode;
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
