<?php

namespace App\Infrastructure\Dao;

use App\Infrastructure\Dao\Dao;
use PDO;
use Exception;

final class CertificationCodeDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertPasswordCertification(
        $user_id,
        $certificationCode
    ): void {
        $sql = <<<EOF
    INSERT INTO 
      certifications
    (user_id, certification_code)
    VALUES
    (:user_id, :certification_code)
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(
            ':certification_code',
            $certificationCode,
            PDO::PARAM_STR
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
