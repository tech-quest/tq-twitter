<?php

namespace App\Domain\Entity;

use DateTime;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\HashedCertificationCode;
use App\Domain\ValueObject\DateTimeInDB;

final class PasswordResetCertification
{
  private UserId $userId;
  private DateTimeInDB $expiredDatetime;

  public function __construct(UserId $userId, DateTimeInDB $expiredDatetime)
  {
    $this->userId = $userId;
    $this->expiredDatetime = $expiredDatetime;
  }

  public function userId(): UserId
  {
    return $this->userId;
  }

  public function expiredDatetime(): DateTimeInDB
  {
    return $this->expiredDatetime;
  }

  public function isExpired(): bool
  {
    $datetime = DateTime::createFromFormat(DateTimeInDB::DEFAULT_FORMAT, $this->expiredDatetime->value());
    $now = new DateTime('now');
    return $datetime < $now;
  }
}
