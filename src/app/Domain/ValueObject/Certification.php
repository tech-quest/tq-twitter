<?php

namespace App\Domain\ValueObject;

final class Certification
{
    private const HASH_ALGORITHM = 'sha3-512';

    private string $code;
    private Email $email;

    public function __construct(Email $email)
    {
        $this->code = $this->generateCode();
        $this->email = $email;
    }

    public function generateHash(): string
    {
        return $this->hashEmailWithCode($this->code);
    }

    public function generateHashFromCode(string $code): string
    {
        return $this->hashEmailWithCode($code);
    }

    public function code(): string
    {
        return $this->code;
    }

    private function hashEmailWithCode(string $code): string
    {
        $emailCertificationCode = $this->email->value() . $code;
        return hash(self::HASH_ALGORITHM, $emailCertificationCode);
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
