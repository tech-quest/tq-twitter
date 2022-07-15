<?php

namespace App\Domain\Adapter;

use App\Domain\ValueObject\CertificationCode;
use App\Domain\Entity\PasswordResetCertificationOnSave;

interface PasswordResetCertificationRepositoryInterface
{
  public function create(PasswordResetCertificationOnSave $certification): void;
  public function delete(CertificationCode $certificationCode): void;
}
