<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Birthday;

final class ProfileBirthday
{
    private $userId;
    private $birthday;

    public function __construct(UserId $userId, Birthday $birthday)
    {
        $this->userId = $userId;
        $this->birthday = $birthday;
    }

    public function id(): UserId
    {
        return $this->userId;
    }
}
