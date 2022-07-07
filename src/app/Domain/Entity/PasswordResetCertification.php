<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\DateTimeInDB;

final class PasswordResetCertification
{
  private UserId $userId;
  private string $code;
  private DateTimeInDB $expiredDatetime;

  public function __construct(UserId $userId, string $code, DateTimeInDB $expiredDatetime)
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

  public function expiredDatetime(): DateTimeInDB
  {
    return $this->expiredDatetime;
  }
}
