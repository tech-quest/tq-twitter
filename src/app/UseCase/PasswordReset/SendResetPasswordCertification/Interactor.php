<?php

namespace App\UseCase\PasswordReset\SendResetPasswordCertification;

use App\Infrastructure\Dao\UserDao;
use App\UseCase\PasswordReset\SendResetPasswordCertification\Input;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Domain\ValueObject\Email;
use App\UseCase\PasswordReset\PasswordCertificationSender;
use Exception;
use App\Lib\Session;
use App\Domain\ValueObject\Certification;

final class Interactor
{
    private const CERTIFICATION_EXPIRED_MINUTES = 5;
    private Input $input;

    public function __construct(Input $input)
    {
        $this->userDao = new UserDao();
        $this->input = $input;
    }

    public function handler()
    {
        $certification = new Certification($this->input->email());
        $hashCertificationCode = $certification->generateHash();
        $this->insertPasswordCertification($hashCertificationCode);
        $this->saveUserInfo();
        $this->sendCertificationCodeMail($certification->Code());
    }

    private function findByUser(): ?array
    {
        return $this->userDao->findByEmail($this->input->email()->value());
    }

    private function insertPasswordCertification($hashCertificationCode): void
    {
        $user = $this->findByUser();
        $certificationCodeDao = new CertificationCodeDao();
        $certificationCodeDao->insertPasswordCertification(
            $user['id'],
            $hashCertificationCode,
            self::CERTIFICATION_EXPIRED_MINUTES
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
