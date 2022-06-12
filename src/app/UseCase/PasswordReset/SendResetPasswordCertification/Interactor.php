<?php

namespace App\UseCase\PasswordReset\SendResetPasswordCertification;

use App\Infrastructure\Dao\UserDao;
use App\UseCase\PasswordReset\SendResetPasswordCertification\Input;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Domain\ValueObject\Email;
use App\UseCase\PasswordReset\PasswordCertificationSender;
use Exception;
use App\Lib\Session;

final class Interactor
{
    private Input $input;

    public function __construct(Input $input)
    {
        $this->userDao = new UserDao();
        $this->input = $input;
    }

    public function handler()
    {
        $certificationCode = $this->code();
        $emailCertificationCode = $this->emailCode($certificationCode);
        $hashCertificationCode = $this->hashCode($emailCertificationCode);
        $this->insertPasswordCertification($hashCertificationCode);
        $this->saveUserInfo();
        $this->sendCertificationCodeMail($certificationCode);
    }

    private function findByUser(): ?array
    {
        return $this->userDao->findByEmail($this->input->email()->value());
    }

    private function code(): string
    {
        $certificationCode = chr(mt_rand(97, 122));
        for ($i = 0; $i < 10; $i++) {
            $certificationCode .= chr(mt_rand(97, 122));
        }
        return $certificationCode;
    }

    private function emailCode($certificationCode): string
    {
        $user = $this->findByUser();
        return $user['email'] . $certificationCode;
    }

    private function hashCode($emailCertificationCode): string
    {
        return hash('sha3-512', $emailCertificationCode);
    }

    private function insertPasswordCertification($hashCertificationCode): void
    {
        $user = $this->findByUser();
        $certificationCodeDao = new CertificationCodeDao();
        $certificationCodeDao->insertPasswordCertification(
            $user['id'],
            $hashCertificationCode
        );
    }

    private function saveUserInfo()
    {
        $user = $this->findByUser();
        $session = Session::getInstance();
        $session->setCertificateEmail(new Email($user['email']));
        $session->setUserEmail(new Email($user['email']));
    }

    private function sendCertificationCodeMail($certificationCode)
    {
        $user = $this->findByUser();

        try {
            $passwordCertificationSender = new PasswordCertificationSender(
                $user,
                $certificationCode
            );
            return $passwordCertificationSender->send();
        } catch (Exception $e) {
            return 'error:' . $e->getMessage();
        }
    }
}