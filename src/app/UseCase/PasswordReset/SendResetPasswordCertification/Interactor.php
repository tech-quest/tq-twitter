<?php

namespace App\UseCase\PasswordReset\SendResetPasswordCertification;

use Exception;
use DateTime;
use App\Lib\Session;
use App\UseCase\PasswordReset\PasswordCertificationSender;
use App\Adapter\QueryService\UserQueryService;
use App\Adapter\Repository\PasswordResetCertificationRepository;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\ValueObject\FutureDateTimeInDB;
use App\Domain\Entity\User;
use App\Domain\Entity\PasswordResetCertificationOnSave;

final class Interactor
{
    private const CERTIFICATION_EXPIRED_MINUTES = 5;
    private Input $input;
    private PasswordResetCertificationRepository $certificationRepository;
    private UserQueryService $userQueryService;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->certificationRepository = new PasswordResetCertificationRepository();
        $this->userQueryService = new UserQueryService();
    }

    public function handler()
    {
        $user = $this->findUser();
        $expiredDatetime = $this->generateExpiredDateTime();
        $certification = new PasswordResetCertificationOnSave(
            $user->id(),
            new CertificationCode($this->generateCode(), $this->input->email()),
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
        $this->certificationRepository->create($certification);
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

    private function generateCode(): string
    {
        $certificationCode = $this->randChr();
        for ($i = 0; $i < 10; $i++) {
            $certificationCode .= $this->randChr();
        }
        return $certificationCode;
    }

    private function randChr(): string
    {
        return chr(mt_rand(97, 122));
    }
}
