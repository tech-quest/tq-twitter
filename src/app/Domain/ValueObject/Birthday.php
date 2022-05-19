<?php

namespace App\Domain\ValueObject;

use Exception;
use DateTime;

final class Birthday
{
    private DateTime $value;

    public function __construct(DateTime $value)
    {
        if ($this->isAfterToday($value)) {
            throw new Exception('誕生日に未来の日付は指定できません');
        }
        $this->value = $value;
    }

    public function value(): DateTime
    {
        return $this->value;
    }

    private function isAfterToday(DateTime $birthday): bool
    {
        $today = date('Y-m-d');
        return (strtotime($today) < strtotime($birthday->format('Y-m-d')));
    }
}
