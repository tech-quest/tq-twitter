<?php

namespace App\ValueObject;

use Exception;

final class TweetId
{
    private $value;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new Exception('TweetIdは1以上で指定してください');
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
