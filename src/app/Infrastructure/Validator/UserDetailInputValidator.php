<?php

namespace App\Infrastructure\Validator;

use App\Infrastructure\Dao\UserDao;

final class UserDetailInputValidator
{
    public const ERROR_TEXT = 'Emailか名前が違います';
    private $name;
    private $email;

    public function __construct(?string $name, ?string $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->userDao = new UserDao();
    }

    private function nameErrorText(): ?string
    {
        $findByEmail = $this->userDao->findByEmail($this->email);

        if (empty($this->name)) {
            return self::ERROR_TEXT;
        }

        if ($findByEmail['name'] != $this->name) {
            return self::ERROR_TEXT;
        }

        return null;
    }

    private function emailErrorText(): ?string
    {
        $findByEmail = $this->userDao->findByEmail($this->email);

        if (empty($this->email)) {
            return self::ERROR_TEXT;
        }

        if ($findByEmail['email'] != $this->email) {
            return self::ERROR_TEXT;
        }

        return null;
    }

    public function allErrors(): array
    {
        $errors = [$this->nameErrorText(), $this->emailErrorText()];
        return array_filter($errors);
    }
}
