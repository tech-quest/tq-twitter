<?php

namespace App\UseCase\SearchTweetUseCase;

use App\ValueObject\AuthUser;
use App\ValueObject\UserId;
use App\ValueObject\Email;

final class SearchTweetInput
{
    private $authUser;

    public function __construct(AuthUser $authUser)
    {
        $this->authUser = $authUser;
    }

    public function userId(): UserId
    {
        return $this->authUser->userId();
    }

    public function userName(): string
    {
        return $this->authUser->userName();
    }

    public function email(): Email
    {
        return $this->authUser->email();
    }
}
