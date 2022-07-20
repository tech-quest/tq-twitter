<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\CertificationCode;

final class Input
{
    private Email $email;
    private CertificationCode $certificationCode;

    public function __construct(Email $email, CertificationCode $certificationCode)
    {
        $this->email = $email;
        $this->certificationCode = $certificationCode;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function certificationCode(): CertificationCode
    {
        return $this->certificationCode;
    }
}
