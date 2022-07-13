<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\Adapter\QueryService\PasswordResetCertificationQueryService;
use App\Adapter\Repository\PasswordResetCertificationRepository;
use App\Lib\Session;
use App\Domain\ValueObject\UserId;
use App\Domain\Entity\PasswordResetCertification;

final class Interactor
{
    private const SUCCESS_MESSAGE = '認証に成功しました';

    private const FAILURE_MESSAGE = '認証コードが違います';

    private const EXPIRED_MESSAGE = '認証コードの有効期限が切れています。お手数ですがページをリロードし、操作を最初からやり直してください。';

    private Input $input;

    private PasswordResetCertificationQueryService $certificationQueryService;

    private PasswordResetCertificationRepository $certificationRepository;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->certificationQueryService = new PasswordResetCertificationQueryService();
        $this->certificationRepository = new PasswordResetCertificationRepository();
    }

    public function handler(): Output
    {
        $certification = $this->findByCertificationCode();
        if (is_null($certification)) {
            return new Output(false, self::FAILURE_MESSAGE);
        }

        if ($this->isExpired($certification->expiredDatetime()->value())) {
            $this->deleteCertification();
            return new Output(false, self::EXPIRED_MESSAGE);
        }

        $this->saveUserInfo($certification);
        $this->saveCerificationCode();
        return new Output(true, self::SUCCESS_MESSAGE);
    }

    private function findByCertificationCode(): ?PasswordResetCertification
    {
        return $this->certificationQueryService->findByCertificationCode(
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

    private function isExpired(string $expiredDatetime): bool
    {
        $now = new \DateTime();
        return $expiredDatetime < $now->format('Y-m-d H:i:s');
    }
}
