<?php

namespace App\Domain\ValueObject;

use Exception;

final class UserId
{
    private $value;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new Exception('UserIdは1以上で指定してください');
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
