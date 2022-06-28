<?php

namespace App\UseCase\PasswordReset\ConfirmUserCertification;

use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Lib\Session;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Certification;

final class Interactor
{
    private const SUCCESS_MESSAGE = '認証に成功しました';

    private const FAILURE_MESSAGE = '認証コードが違います';

    private const EXPIRED_MESSAGE = '認証コードの有効期限が切れています。お手数ですがページをリロードし、操作を最初からやり直してください。';

    private Input $input;

    public function __construct(Input $input)
    {
        $this->certificationCodeDao = new CertificationCodeDao();
        $this->input = $input;
    }

    public function handler(): Output
    {
        $certification = $this->findByCertificationCode();
        if (is_null($certification)) {
            return new Output(false, self::FAILURE_MESSAGE);
        }

        if ($this->isExpired($certification['expire_datetime'])) {
            $this->deleteByUserId($certification['user_id']);
            return new Output(false, self::EXPIRED_MESSAGE);
        }

        $this->saveUserInfo();
        return new Output(true, self::SUCCESS_MESSAGE);
    }

    private function findByCertificationCode(): ?array
    {
        $certificationCode = new Certification($this->input->email());
        $hash = $certificationCode->generateHashByVerificationCode($this->input->certificationCode());
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

    private function deleteByUserId(int $userId): void
    {
        // TODO: User IDで削除対象を判別しているので関数名を修正する
        $this->certificationCodeDao->deleteByCertificationCode($userId);
    }

    private function isExpired(string $expiredDatetime): bool
    {
        $now = new \DateTime();
        return $expiredDatetime < $now->format('Y-m-d H:i:s');
    }
}
