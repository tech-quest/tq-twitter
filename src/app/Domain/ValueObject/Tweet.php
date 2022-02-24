<?php

namespace App\ValueObject;

use Exception;

final class Tweet
{
    private $value;

    public function __construct(string $value)
    {
        if ($value <= 140) {
            throw new Exception('Tweetは140字以内で投稿してください');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
