<?php

namespace App\Domain\ValueObject;

use Exception;

final class TweetBody
{
    private $value;

    public function __construct(string $value)
    {
        if (140 <= strlen($value)) {
            throw new Exception('Tweetは140字以内で投稿してください');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
