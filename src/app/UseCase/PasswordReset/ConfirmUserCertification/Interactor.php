<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Lib\Session;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\PasswordResetCertificationCode;

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

    private function findByCertificationCode(): ?array
    {
        $certificationCode = new PasswordResetCertificationCode($this->input->email());
        $hash = $certificationCode->generateHashFromCode($this->input->certificationCode());
        return $this->certificationCodeDao->findByCertificationCode(
            $hash
        );
    }

    private function saveUserInfo()
    {
        $userCertificationCode = $this->findByCertificationCode();
        $session = Session::getInstance();
        $session->setUserId(new UserId($userCertificationCode['user_id']));
    }
}
