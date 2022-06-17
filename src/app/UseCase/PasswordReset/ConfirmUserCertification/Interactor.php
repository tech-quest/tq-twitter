<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Lib\Session;
use App\Domain\ValueObject\UserId;

final class Interactor
{
    private const SUCCESS_MESSAGE = '認証に成功しました';

    private const FAILURE_MESSAGE = '認証コードが違います';

    private Input $input;

    public function __construct(Input $input)
    {
        $this->certificationCodeDao = new CertificationCodeDao();
        $this->input = $input;
    }

    public function handler(): Output
    {
        if (is_null($this->findByCertificationCode())) {
            return new Output(false, self::FAILURE_MESSAGE);
        }

        $this->saveUserInfo();
        return new Output(true, self::SUCCESS_MESSAGE);
    }

    private function emailCertificationCode(): string
    {
        return $this->input->email()->value() . $this->input->certificationCode();
    }

    private function hashEmailCertificationCode(): string
    {
        return hash('sha3-512', $this->emailCertificationCode());
    }

    private function findByCertificationCode(): ?array
    {
        return $this->certificationCodeDao->findByCertificationCode(
            $this->hashEmailCertificationCode()
        );
    }

    private function saveUserInfo()
    {
        $userCertificationCode = $this->findByCertificationCode();
        $session = Session::getInstance();
        $session->setUserId(new UserId($userCertificationCode['user_id']));
    }
}
