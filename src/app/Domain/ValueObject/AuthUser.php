<?php

namespace App\Domain\ValueObject;

final class AuthUser
{
    private $userId;
    private $userName;
    private $email;

    public function __construct(UserId $userId, Name $userName, Email $email)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->email = $email;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function userName(): Name
    {
        return $this->userName;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
