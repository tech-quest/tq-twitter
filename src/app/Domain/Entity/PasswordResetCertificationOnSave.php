<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\ValueObject\FutureDateTimeInDB;

final class PasswordResetCertificationOnSave
{
  private UserId $userId;
  private CertificationCode $code;
  private FutureDateTimeInDB $expiredDatetime;

  public function __construct(UserId $userId, CertificationCode $code, FutureDateTimeInDB $expiredDatetime)
  {
    $this->userId = $userId;
    $this->code = $code;
    $this->expiredDatetime = $expiredDatetime;
  }

  public function userId(): UserId
  {
    return $this->userId;
  }

  public function code(): CertificationCode
  {
    return $this->code;
  }

  public function expiredDatetime(): FutureDateTimeInDB
  {
    return $this->expiredDatetime;
  }
}
