<?php

namespace App\Domain\ValueObject;

use Exception;

final class Password
{
    private const PATTERN =  '/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,24}+\z/';
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

    public static function isValid(string $password): bool
    {
        return preg_match(self::PATTERN, $password);
    }
}
