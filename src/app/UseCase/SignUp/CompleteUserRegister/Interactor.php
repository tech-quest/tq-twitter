<?php

namespace App\UseCase\SignUp\CompleteUserRegister;

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;

final class Interactor
{
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->userDao = new UserDao();
        $this->userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
    }

    public function handler()
    {
        $result = $this->insertUserInfo();
        $this->deleteByRegisterCertificationCode();
        return $result;
    }

    private function createPasswordHash(): string
    {
        return password_hash($this->input->password(), PASSWORD_DEFAULT);
    }

    private function insertUserInfo(): bool
    {
        return $this->userDao->insertUser(
            $this->input->name()->value(),
            $this->input->email()->value(),
            $this->createPasswordHash()
        );
    }

    private function deleteByRegisterCertificationCode()
    {
        $this->userRegisterCertificationCodeDao->deleteByRegisterCertificationCode(
            $this->input->hashCertificateRegisterCode()
        );
    }
}
