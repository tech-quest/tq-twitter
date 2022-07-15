<?php

namespace App\Domain\Adapter;

use App\Domain\ValueObject\CertificationCode;
use App\Domain\Entity\PasswordResetCertification;

interface PasswordResetCertificationQueryServiceInterface
{
  public function findByCertificationCode(CertificationCode $certificationCode): ?PasswordResetCertification;
}
