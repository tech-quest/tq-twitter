<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\UseCase\PasswordReset\ConfirmUserCertification\Output;
use App\Lib\Session;
use App\Domain\Entity\PasswordResetCertification;
use App\Domain\Adapter\PasswordResetCertificationQueryServiceInterface;
use App\Domain\Adapter\PasswordResetCertificationRepositoryInterface;

final class Interactor
{
    private const SUCCESS_MESSAGE = '認証に成功しました';

    private const FAILURE_MESSAGE = '認証コードが違います';

    private const EXPIRED_MESSAGE = '認証コードの有効期限が切れています。お手数ですがページをリロードし、操作を最初からやり直してください。';

    private Input $input;

    private PasswordResetCertificationQueryServiceInterface $certificationQuery;

    private PasswordResetCertificationRepositoryInterface $certificationRepository;

    public function __construct(Input $input, PasswordResetCertificationQueryServiceInterface $certificationQuery, PasswordResetCertificationRepositoryInterface $certificationRepository)
    {
        $this->input = $input;
        $this->certificationQuery = $certificationQuery;
        $this->certificationRepository = $certificationRepository;
    }

    public function handler(): Output
    {
        $certification = $this->findByCertificationCode();
        if (is_null($certification)) {
            return new Output(false, self::FAILURE_MESSAGE);
        }

        if ($certification->isExpired()) {
            $this->deleteCertification();
            return new Output(false, self::EXPIRED_MESSAGE);
        }

        $this->saveUserInfo($certification);
        $this->saveCerificationCode();
        return new Output(true, self::SUCCESS_MESSAGE);
    }

    private function findByCertificationCode(): ?PasswordResetCertification
    {
        return $this->certificationQuery->findByCertificationCode(
            $this->input->certificationCode()
        );
    }

    private function saveUserInfo(PasswordResetCertification $certification): void
    {
        $session = Session::getInstance();
        $session->setUserId($certification->userId());
    }

    private function saveCerificationCode(): void
    {
        $session = Session::getInstance();
        $session->setPasswordCertificationCode($this->input->certificationCode()->value());
    }

    private function deleteCertification(): void
    {
        $this->certificationRepository->delete($this->input->certificationCode());
    }
}
