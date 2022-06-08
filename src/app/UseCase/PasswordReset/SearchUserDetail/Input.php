<?php

namespace App\UseCase\PasswordReset\SearchUserDetail;

use App\Domain\ValueObject\Email;

final class Input
{
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
