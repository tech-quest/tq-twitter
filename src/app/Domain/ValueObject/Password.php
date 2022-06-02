<?php

namespace App\Domain\ValueObject;

use Exception;

final class Password
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function hashAsString(): string
    {
        return password_hash($this->value, PASSWORD_DEFAULT);
    }
}
