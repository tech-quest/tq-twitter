<?php

namespace App\Domain\ValueObject;

use Exception;

final class Email
{
    const EMAIL_VALIDATION_PATTERN = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
    private $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new Exception('値を入力してください');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function isValid(string $email): bool
    {
        return preg_match(self::EMAIL_VALIDATION_PATTERN, $email);
    }
}
