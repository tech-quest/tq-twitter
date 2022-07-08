<?php

namespace App\Infrastructure\Dao;

use PDO;
use Exception;
use App\Domain\Entity\PasswordResetCertificationOnSave;

final class CertificationCodeDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertPasswordCertification(PasswordResetCertificationOnSave $certification): void
    {
        $sql = <<<EOF
    INSERT INTO 
      certifications
    (user_id, certification_code, expire_datetime)
    VALUES
    (:user_id, :certification_code, :expired_datetime)
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $certification->userId()->value(), PDO::PARAM_INT);
        $stmt->bindValue(
            ':certification_code',
            $certification->code()->value(),
            PDO::PARAM_STR
        );
        $stmt->bindValue(
            ':expired_datetime',
            $certification->expiredDatetime()->value(),
            PDO::PARAM_INT
        );

        $res = $stmt->execute();
        if (!$res) {
            throw new Exception('認証情報の保存に失敗しました');
        }
    }

    public function findByCertificationCode(string $certificationCode): ?array
    {
        $sql = <<<EOF
    SELECT
      *
    FROM
      certifications
    WHERE
      certification_code = :certification_code
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(
            ':certification_code',
            $certificationCode,
            PDO::PARAM_STR
        );
        $stmt->execute();
        $certificationCode = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($certificationCode === false) {
            return null;
        }
        return $certificationCode;
    }

    public function deleteByCertificationCode(int $userId)
    {
        $sql = <<<EOF
  DELETE FROM
    certifications
  WHERE
    user_id = :user_id
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
