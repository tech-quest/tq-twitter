<?php

namespace App\Adapter\Repository;

use App\Infrastructure\Dao\PasswordResetCertificationDao;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\Entity\PasswordResetCertificationOnSave;

final class PasswordResetCertificationRepository
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
