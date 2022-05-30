<?php

namespace App\UseCase\SignUp\CompleteUserRegister;

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\UseCase\SignUp\CompleteUserRegister\Input;
use App\UseCase\SignUp\CompleteUserRegister\Output;

final class Interactor
{
    private const COMPLETE_MESSAGE = '登録が完了しました。';
    private const NOT_COMPLETE_MESSAGE = '登録が出来ませんでした。';
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->userDao = new UserDao();
        $this->userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
    }

    public function handler(): Output
    {
        if ($this->isExistsUser()) {
            $this->deleteByRegisterCertificationCode();
            return new Output(true, self::COMPLETE_MESSAGE);
        }

        return new Output(false, self::NOT_COMPLETE_MESSAGE);
    }
    private function createPasswordHash(): string
    {
        return password_hash($this->input->password(), PASSWORD_DEFAULT);
    }

    private function isExistsUser(): bool
    {
        return $this->userDao->insertUser(
            $this->input->name()->value(),
            $this->input->email()->value(),
            $this->createPasswordHash()
        );
    }

    private function deleteByRegisterCertificationCode(): void
    {
        $this->userRegisterCertificationCodeDao->deleteByRegisterCertificationCode(
            $this->input->hashCertificateRegisterCode()
        );
    }
}
