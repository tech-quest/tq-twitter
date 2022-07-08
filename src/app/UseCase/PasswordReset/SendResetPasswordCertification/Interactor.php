<?php

namespace App\UseCase\PasswordReset\SendResetPasswordCertification;

use Exception;
use DateTime;
use App\Lib\Session;
use App\UseCase\PasswordReset\PasswordCertificationSender;
use App\Adapter\QueryService\UserQueryService;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\ValueObject\FutureDateTimeInDB;
use App\Domain\Entity\User;
use App\Domain\Entity\PasswordResetCertificationOnSave;

final class Interactor
{
    private const CERTIFICATION_EXPIRED_MINUTES = 5;
    private Input $input;
    private UserQueryService $userQueryService;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->userQueryService = new UserQueryService();
    }

    public function handler()
    {
        $user = $this->findUser();
        $expiredDatetime = $this->generateExpiredDateTime();
        $certification = new PasswordResetCertificationOnSave(
            $user->id(),
            new CertificationCode(),
            new FutureDateTimeInDB($expiredDatetime->format(FutureDateTimeInDB::DEFAULT_FORMAT))
        );
        $this->insertPasswordCertification($certification);
        $this->saveUserInfo($user);
        $this->sendCertificationCodeMail($user, $certification);
    }

    private function generateExpiredDateTime(): DateTime
    {
        $now = new DateTime('now');
        return $now->modify(sprintf('+%d minute', self::CERTIFICATION_EXPIRED_MINUTES));
    }

    private function findUser(): ?User
    {
        return $this->userQueryService->findByEmail($this->input->email());
    }

    private function insertPasswordCertification(PasswordResetCertificationOnSave $certification): void
    {
        $certificationCodeDao = new CertificationCodeDao();
        $certificationCodeDao->insertPasswordCertification(
            $certification
        );
    }

    private function saveUserInfo(User $user)
    {
        $session = Session::getInstance();
        $session->setCertificateEmail($user->email());
        $session->setUserEmail($user->email());
    }

    private function sendCertificationCodeMail(User $user, PasswordResetCertificationOnSave $certification)
    {
        try {
            $passwordCertificationSender = new PasswordCertificationSender($user, $certification);
            return $passwordCertificationSender->send();
        } catch (Exception $e) {
            return 'error:' . $e->getMessage();
        }
    }
}
