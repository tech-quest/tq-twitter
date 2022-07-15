<?php

namespace App\Adapter\PasswordResetCertification;

use App\Domain\Entity\PasswordResetCertification;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\DateTimeInDB;

final class PasswordResetCertificationFactory
{
    public static function create(array $mapper): PasswordResetCertification
    {
        return new PasswordResetCertification(
            new UserId($mapper['user_id']),
            new DateTimeInDB($mapper['expire_datetime'])
        );
    }
}
