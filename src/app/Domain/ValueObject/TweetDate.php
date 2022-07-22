<?php

namespace App\Domain\ValueObject;

use DateTime;

final class TweetDate
{
    private $date;

    public function __construct($date)
    {
        $this->date = new DateTime($date);
    }

    public function date()
    {
        if (strpos($this->date->format('H:i A'), 'AM')) {
            return $this->date->format('午前H:i・Y年m月d日');
        }
        if (strpos($this->date->format('H:i A'), 'PM')) {
            return $this->date->format('午後H:i・Y年m月d日');
        }
    }
}
