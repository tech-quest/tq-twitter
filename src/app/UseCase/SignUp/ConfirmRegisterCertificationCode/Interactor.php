<?php

namespace App\UseCase\SignUp\ConfirmRegisterCertificationCode;

use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\UseCase\SignUp\ConfirmRegisterCertificationCode\Input;
use App\UseCase\SignUp\ConfirmRegisterCertificationCode\Output;

final class Interactor
{
    private const CONFIRM_MESSAGE = '認証コードが見つかりました。';
    private const NOT_CONFIRM_MESSAGE = '認証コードが見つかりませんでした。';
    private Input $input;

    public function __construct(Input $input)
    {
        $this->userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
        $this->input = $input;
    }

    public function handler(): Output
    {
        if ($this->findByRegisterCertificationCode()) {
            return new Output(false, self::NOT_CONFIRM_MESSAGE);
        }
        return new Output(true, self::CONFIRM_MESSAGE);
    }

    private function createCertificationCode(): string
    {
        return $this->input->email()->value() . $this->input->code();
    }

    private function createHashEmailCertificationCode(): string
    {
        return hash('sha3-512', $this->createCertificationCode());
    }

    private function findByRegisterCertificationCode(): bool
    {
        $code = $this->userRegisterCertificationCodeDao->findByRegisterCertificationCode(
            $this->createHashEmailCertificationCode()
        );
        return is_null($code);
    }
}
