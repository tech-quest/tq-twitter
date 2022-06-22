<?php

namespace App\UseCase\PasswordReset\SearchUserDetail;

final class Output
{
    private bool $isSuccess;
    private ?string $email;

    public function __construct(bool $isSuccess, ?string $email)
    {
        $this->isSuccess = $isSuccess;
        $this->email = $email;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function email(): ?string
    {
        return $this->email;
    }
}
