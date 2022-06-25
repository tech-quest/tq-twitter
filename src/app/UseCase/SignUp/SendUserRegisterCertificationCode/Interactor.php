<?php

namespace App\UseCase\SignUp\SendUserRegisterCertificationCode;

use App\Infrastructure\Dao\UserDao;
use App\UseCase\SignUp\SendUserRegisterCertificationCode\Input;
use App\UseCase\SignUp\SendUserRegisterCertificationCode\Output;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\UseCase\SignUp\SendCertificationCode\SignUpCertificationSender;
use Exception;
use App\Lib\Session;
use App\Domain\ValueObject\Certification;

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

        $signUpCertificationCode = new Certification($this->input->email());
        $this->insertRegisterCertification($signUpCertificationCode);
        $this->saveUserInfo($signUpCertificationCode);
        $this->sendCertificationCodeMail($signUpCertificationCode);

        return new Output(true, self::NOT_REGISTERD_MESSAGE);
    }

    private function saveUserInfo(Certification $Certification): void
    {
        $session = Session::getInstance();
        $session->setRegisterCertificateEmail($this->input->email());
        $session->setUserName($this->input->name());
        $session->setHashCertificateEmail($Certification->generateHash());
    }

    private function sendCertificationCodeMail(Certification $Certification)
    {
        try {
            $signUpCertificationSender = new SignUpCertificationSender($Certification->code());
            return $signUpCertificationSender->send();
        } catch (Exception $e) {
            return 'error:' . $e->getMessage();
        }
    }

    private function insertRegisterCertification(Certification $Certification): void
    {
        $userRegisterCodeDao = new UserRegisterCertificationCodeDao();
        $userRegisterCodeDao->insertRegisterCertification($Certification->generateHash());
    }

    private function existsUserByEmail(): bool
    {
        $email = $this->input->email();
        $user = $this->userDao->findByEmail($email->value());
        return !is_null($user);
    }
}
