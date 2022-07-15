<?php

namespace App\Adapter\PasswordResetCertification\Query;

use App\Adapter\PasswordResetCertification\PasswordResetCertificationFactory;
use App\Infrastructure\Dao\PasswordResetCertificationDao;
use App\Domain\Adapter\PasswordResetCertificationQueryServiceInterface;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\Entity\PasswordResetCertification;

final class PasswordResetCertificationQueryService implements PasswordResetCertificationQueryServiceInterface
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

    return PasswordResetCertificationFactory::create($mapper);
  }
}
