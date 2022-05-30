<?php

namespace App\UseCase\SignUp\CompleteUserRegister;

final class Output
{
    private bool $isSuccess;
    private string $message;

    public function __construct(bool $isSuccess, string $message)
    {
        $this->isSuccess = $isSuccess;
        $this->message = $message;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function message(): string
    {
        return $this->message;
    }
}
