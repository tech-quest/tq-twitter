<?php

namespace App\Infrastructure\Dao;

use App\Infrastructure\Dao\Dao;
use PDO;

final class UserRegisterCertificationCodeDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertRegisterCertification($certificationCode): void
    {
        $sql = <<<EOF
    INSERT INTO 
      user_register_certifications
    (certification_code)
    VALUES
    (:certification_code)
EOF;
        $stmt = $this->pdo->prepare($sql);
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

    public function findByRegisterCertificationCode(
        string $certificationCode
    ): ?array {
        $sql = <<<EOF
    SELECT
      *
    FROM
      user_register_certifications
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
        return empty($certificationCode) ? null : $certificationCode;
    }

    public function deleteByRegisterCertificationCode(
        string $hashCertificateRegisterCode
    ) {
        $sql = <<<EOF
    DELETE FROM
      user_register_certifications
    WHERE
      certification_code = :certification_code
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(
            ':certification_code',
            $hashCertificateRegisterCode,
            PDO::PARAM_STR
        );
        $stmt->execute();
    }
}
