<?php

namespace App\UseCase\PasswordReset\CompletePasswordReset;

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Infrastructure\Validator\PasswordInputValidator;
use App\UseCase\PasswordReset\CompletePasswordReset\Input;

final class Interactor
{
    private const ILLEGAL_PASSWORD_MESSAGE = '不正な形式のパスワードです';
    private const NEW_PASSWORD_MESSAGE = 'パスワードを変更しました';
    private Input $input;

    public function __construct(Input $input)
    {
        $this->userDao = new UserDao();
        $this->certificationCodeDao = new CertificationCodeDao();
        $this->input = $input;
    }

    public function handler(): Output
    {
        if ($this->isPasswordValid()) {
            return new Output(false, self::ILLEGAL_PASSWORD_MESSAGE);
        }

        $this->updatePassword();
        $this->deleteByCertificationCode();
        return new Output(true, self::NEW_PASSWORD_MESSAGE);
    }

    private function isPasswordValid(): ?string
    {
        $password = new PasswordInputValidator($this->input->newPassword()->value());
        return !is_null($password->passwordErrorText());
    }

    private function updatePassword(): void
    {
        $this->userDao->updatePassword($this->input->userId()->value(), $this->input->newPassword()->hashAsString());
    }

    private function deleteByCertificationCode(): void
    {
        $this->certificationCodeDao->deleteByCertificationCode($this->input->userId()->value());
    }
}
