<?php

namespace App\Domain\ValueObject;

use Exception;
use DateTime;

final class Birthday
{
    private $value;

    public function __construct(?DateTime $value)
    {
        $this->value = $value;
    }

    public function value(): ?DateTime
    {
        $today = date('Y-m-d');
        $birthday = date('Y-m-d', $this->value);
        if (strtotime($today) < strtotime($birthday)) {
            throw new Exception('誕生日に未来の日付は指定できません');
        }
        return $this->value;
    }
}
