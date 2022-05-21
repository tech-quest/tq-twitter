<?php

namespace App\UseCase\SignUp\SendUserRegisterCertificationCode;

use App\Infrastructure\Dao\UserDao;
use App\UseCase\SignUp\SendUserRegisterCertificationCode\Input;
use App\UseCase\SignUp\SendUserRegisterCertificationCode\Output;
use App\Domain\ValueObject\SignUpCertificationCode;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\UseCase\SignUp\SendCertificationCode\SignUpCertificationSender;
use Exception;
use App\Lib\Session;

final class Interactor
{
    private const REGISTERD_MESSAGE = 'メールアドレスが登録されています。';
    private const NOT_REGISTERD_MESSAGE = 'まだ登録されていないメールアドレスです。';
    private Input $input;

    public function __construct(Input $input)
    {
        $this->userDao = new UserDao();
        $this->input = $input;
    }

    public function handler(): Output
    {
        if ($this->existsUserByEmail()) {
            return new Output(false, self::REGISTERD_MESSAGE);
        }

        $signUpCertificationCode = new SignUpCertificationCode($this->input->email());
        $this->insertRegisterCertification($signUpCertificationCode);
        $this->saveUserInfo();
        $this->sendCertificationCodeMail($signUpCertificationCode);

        return new Output(true, self::NOT_REGISTERD_MESSAGE);
    }

    private function saveUserInfo(): void
    {
        $session = Session::getInstance();
        $session->setRegisterCertificateEmail($this->input->email());
        $session->setUserName($this->input->name());
    }

    private function sendCertificationCodeMail(SignUpCertificationCode $signUpCertificationCode)
    {
        try {
            $signUpCertificationSender = new SignUpCertificationSender($signUpCertificationCode->code());
            return $signUpCertificationSender->send();
        } catch (Exception $e) {
            return 'error:' . $e->getMessage();
        }
    }

    private function insertRegisterCertification(SignUpCertificationCode $signUpCertificationCode): void
    {
        $userRegisterCodeDao = new UserRegisterCertificationCodeDao();
        $userRegisterCodeDao->insertRegisterCertification($signUpCertificationCode->generateHash());
    }

    private function existsUserByEmail(): bool
    {
        $email = $this->input->email();
        $user = $this->userDao->findByEmail($email->value());
        return !is_null($user);
    }
}
