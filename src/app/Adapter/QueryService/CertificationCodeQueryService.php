<?php

namespace App\Adapter\QueryService;

use App\Infrastructure\Dao\Dao;
use App\Domain\ValueObject\UserId;
use PDO;

final class CertificationCodeQueryService extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByCertificationCode(string $certificationCode)
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
  public function findByRegisterCertificationCode(string $certificationCode): ?array
  {
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
