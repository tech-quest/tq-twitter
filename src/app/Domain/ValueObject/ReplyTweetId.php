<?php

namespace App\Domain\ValueObject;

use Exception;

final class ReplyTweetId
{
    private $value;

    public function __construct(?int $value)
    {
        if ($value <= 0 && $value != null) {
            throw new Exception('ReplyTweetIdは1以上で指定してください');
        }

        $this->value = $value;
    }

    public function value(): ?int
    {
        return $this->value;
    }
}
