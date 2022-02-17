<?php

namespace App\ValueObject;

final class Device
{
    const IPHONE = 'iPhone';
    const IPAD = 'iPad';
    const MAC = 'Mac';
    const ANDROID = 'Android';
    const WINDOWS = 'Windows';
    const MOBILE = 'Mobile';

    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function tweetDevice(): string
    {
        if ($this->iPhone()) {
            return self::IPHONE;
        }
        if ($this->iPad()) {
            return self::IPAD;
        }
        if ($this->mac()) {
            return self::MAC;
        }
        if ($this->android()) {
            return self::ANDROID;
        }
        if ($this->windows()) {
            return self::WINDOWS;
        }
    }

    private function iPhone(): bool
    {
        return strpos($this->value, self::IPHONE) !== false &&
            strpos($this->value, self::MOBILE) !== false;
    }

    private function iPad(): bool
    {
        return strpos($this->value, self::IPAD) !== false &&
            strpos($this->value, self::MOBILE) !== false;
    }

    private function mac(): bool
    {
        return strpos($this->value, self::MAC) !== false;
    }

    private function android(): bool
    {
        return strpos($this->value, self::ANDROID) !== false;
    }

    private function windows(): bool
    {
        return strpos($this->value, self::WINDOWS) !== false;
    }
}
