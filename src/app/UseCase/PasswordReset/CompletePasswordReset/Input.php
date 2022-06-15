<?php

namespace App\UseCase\PasswordReset\CompletePasswordReset;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Password;

final class Input
{
    private Password $newPassword;
    private UserId $userId;
    private Email $email;

    public function __construct(Password $newPassword, UserId $userId, Email $email)
    {
        $this->newPassword = $newPassword;
        $this->userId = $userId;
        $this->email = $email;
    }

    public function newPassword(): Password
    {
        return $this->newPassword;
    }
    public function userId(): UserId
    {
        return $this->userId;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
