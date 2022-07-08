<?php

namespace App\Domain\ValueObject;

final class CertificationCode
{
    private const HASH_ALGORITHM = 'sha3-512';

    private string $value;

    public function __construct()
    {
        $this->value = $this->generateCode();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function generateHash(): string
    {
        return $this->hashEmailWithCode($this->value);
    }

    public function generateHashByVerificationCode(string $code): string
    {
        return $this->hashEmailWithCode($code);
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
