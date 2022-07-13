<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\HashedCertificationCode;
use App\Domain\ValueObject\DateTimeInDB;

final class PasswordResetCertification
{
  private UserId $userId;
  private HashedCertificationCode $code;
  private DateTimeInDB $expiredDatetime;

  public function __construct(UserId $userId, HashedCertificationCode $code, DateTimeInDB $expiredDatetime)
  {
    $this->userId = $userId;
    $this->code = $code;
    $this->expiredDatetime = $expiredDatetime;
  }

  public function userId(): UserId
  {
    return $this->userId;
  }

  public function code(): HashedCertificationCode
  {
    return $this->code;
  }

  public function expiredDatetime(): DateTimeInDB
  {
    return $this->expiredDatetime;
  }
}
