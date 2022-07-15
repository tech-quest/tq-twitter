<?php

namespace App\Adapter\QueryService;

use App\Infrastructure\Dao\PasswordResetCertificationDao;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\ValueObject\HashedCertificationCode;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\DateTimeInDB;
use App\Domain\Entity\PasswordResetCertification;

final class PasswordResetCertificationQueryService
{
  private PasswordResetCertificationDao $certificationDao;

  public function __construct()
  {
    $this->certificationDao = new PasswordResetCertificationDao();
  }

  public function findByCertificationCode(CertificationCode $certificationCode): ?PasswordResetCertification
  {
    $mapper = $this->certificationDao->findByCertificationCode($certificationCode->generateHash());
    if (is_null($mapper)) {
      return null;
    }

    return $this->generatePasswordResetCertificationEntity($mapper);
  }

  private function generatePasswordResetCertificationEntity(array $mapper): PasswordResetCertification
  {
    return new PasswordResetCertification(
      new UserId($mapper['user_id']),
      new DateTimeInDB($mapper['expire_datetime'])
    );
  }
}
