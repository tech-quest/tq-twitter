<?php

namespace App\Domain\ValueObject;

final class SignUpCertificationCode
{
    private string $code;
    private Email $email;

    public function __construct(Email $email)
    {
        $this->code = $this->generateCode();
        $this->email = $email;
    }

    public function generateHash(): string
    {
        $emailCertificationCode = $this->email->value() . $this->code;
        return hash('sha3-512', $emailCertificationCode);
    }

    public function code(): string
    {
        return $this->code;
    }

    private function generateCode(): string
    {
        $certificationCode = $this->randChr();
        for ($i = 0; $i < 10; $i++) {
            $certificationCode .= $this->randChr();
        }
        return $certificationCode;
    }

    private function randChr(): string
    {
        return chr(mt_rand(97, 122));
    }
}
