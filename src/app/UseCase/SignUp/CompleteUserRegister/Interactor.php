<?php

namespace App\UseCase\SignUp\CompleteUserRegister;

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\UseCase\SignUp\CompleteUserRegister\Input;
use App\UseCase\SignUp\CompleteUserRegister\Output;
use App\UseCase\SignUp\CompleteUserRegister\Exception\UserInsertFailedException;
use App\Domain\ValueObject\Password;

final class Interactor
{
    private const COMPLETE_MESSAGE = '登録が完了しました。';
    private const NOT_COMPLETE_MESSAGE = '登録に失敗しました。';
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->userDao = new UserDao();
        $this->userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
    }

    public function handler(): Output
    {
        try {
            $this->insertUser();
            $this->deleteByRegisterCertificationCode();
            return new Output(true, self::COMPLETE_MESSAGE);
        } catch (UserInsertFailedException $e) {
            return new Output(false, $e->getMessage());
        }
    }

    private function insertUser(): void
    {
        $password = new Password($this->input->password());
        $res = $this->userDao->insertUser(
            $this->input->name()->value(),
            $this->input->email()->value(),
            $password->hashAsString()
        );

        if (!$res) {
            throw new UserInsertFailedException(self::NOT_COMPLETE_MESSAGE);
        }
    }

    private function deleteByRegisterCertificationCode(): void
    {
        $this->userRegisterCertificationCodeDao->deleteByRegisterCertificationCode(
            $this->input->hashCertificateRegisterCode()
        );
    }
}
