<?php

namespace App\UseCase\SearchTweets;

use App\Domain\ValueObject\AuthUser;

final class SearchTweetsInput
{
    private $authUser;

    public function __construct(AuthUser $authUser)
    {
        $this->authUser = $authUser;
    }

    public function userId(): int
    {
        return $this->authUser->userId()->value();
    }

    public function userName(): string
    {
        return $this->authUser->userName();
    }

    public function email(): string
    {
        return $this->authUser->email()->value();
    }
}
