<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\FutureDateTimeInDB;

final class PasswordResetCertificationOnSave
{
  private UserId $userId;
  private string $code;
  private FutureDateTimeInDB $expiredDatetime;

  public function __construct(UserId $userId, string $code, FutureDateTimeInDB $expiredDatetime)
  {
    $this->userId = $userId;
    $this->code = $code;
    $this->expiredDatetime = $expiredDatetime;
  }

  public function id(): UserId
  {
    return $this->userId;
  }

  public function code(): string
  {
    return $this->code;
  }

  public function expiredDatetime(): FutureDateTimeInDB
  {
    return $this->expiredDatetime;
  }
}
