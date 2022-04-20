<?php

namespace App\Domain\ValueObject;

final class SignUpCertificationCode
{
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function generateHash(string $code): string
    {
        $emailCertificationCode = $this->email->value() . $code;
        return hash('sha3-512', $emailCertificationCode);
    }

    public function generateCode(): string
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
