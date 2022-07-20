<?php

namespace App\Domain\ValueObject;

use Exception;

final class TweetBody
{
    private const MIN_LENGTH = 1;
    private const MAX_LENGTH = 140;
    private $value;

    public function __construct(string $value)
    {
        if (strlen($value) < self::MIN_LENGTH || self::MAX_LENGTH < strlen($value)) {
            throw new Exception('1文字以上、140文字以内で投稿してください');
        }

        $this->value = $value;
    }
    public function value(): string
    {
        return $this->value;
    }
}
