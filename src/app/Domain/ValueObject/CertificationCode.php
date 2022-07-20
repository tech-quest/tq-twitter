<?php

namespace App\Domain\ValueObject;

final class CertificationCode
{
    private const HASH_ALGORITHM = 'sha3-512';

    private string $value;

    private Email $email;

    public function __construct(string $value, Email $email)
    {
        $this->value = $value;
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function generateHash(): string
    {
        $emailCertificationCode = $this->email->value() . $this->value;
        return hash(self::HASH_ALGORITHM, $emailCertificationCode);
    }
}
