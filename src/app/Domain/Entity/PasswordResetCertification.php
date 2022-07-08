<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\CertificationCode;
use App\Domain\ValueObject\DateTimeInDB;

final class PasswordResetCertification
{
  private UserId $userId;
  private CertificationCode $code;
  private DateTimeInDB $expiredDatetime;

  public function __construct(UserId $userId, CertificationCode $code, DateTimeInDB $expiredDatetime)
  {
    $this->userId = $userId;
    $this->code = $code;
    $this->expiredDatetime = $expiredDatetime;
  }

  public function id(): UserId
  {
    return $this->userId;
  }

  public function code(): CertificationCode
  {
    return $this->code;
  }

  public function expiredDatetime(): DateTimeInDB
  {
    return $this->expiredDatetime;
  }
}
