<?php

namespace App\Adapter\PasswordResetCertification\Repository;

use App\Infrastructure\Dao\PasswordResetCertificationDao;
use App\Domain\Adapter\PasswordResetCertificationRepositoryInterface;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\Entity\PasswordResetCertificationOnSave;

final class PasswordResetCertificationRepository implements PasswordResetCertificationRepositoryInterface
{
  private PasswordResetCertificationDao $certificationDao;

  public function __construct()
  {
    $this->certificationDao = new PasswordResetCertificationDao();
  }

  public function create(PasswordResetCertificationOnSave $certification): void
  {
    $this->certificationDao->insertPasswordCertification($certification);
  }

  public function delete(CertificationCode $certificationCode): void
  {
    $this->certificationDao->delete($certificationCode);
  }
}
