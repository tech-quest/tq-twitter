<?php

namespace App\Domain\ValueObject;

final class SearchTweetCondition
{
    private $userId;
    private $tweet;

    public function __construct(UserId $userId, string $tweet)
    {
        $this->userId = $userId;
        $this->tweet = $tweet;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function tweet(): string
    {
        return $this->tweet;
    }
}
