<?php

namespace App\Lib;

final class Device
{
    const IPHONE = 'iPhone';
    const IPAD = 'iPad';
    const MAC = 'Mac';
    const ANDROID = 'Android';
    const WINDOWS = 'Windows';
    const MOBILE = 'Mobile';

    private $device;

    public function __construct(string $device)
    {
        $this->device = $device;
    }

    public function tweetDevice()
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

    private function iPhone()
    {
        return strpos($this->device, self::IPHONE) !== false &&
            strpos($this->device, self::MOBILE) !== false;
    }

    private function iPad()
    {
        return strpos($this->device, self::IPAD) !== false &&
            strpos($this->device, self::MOBILE) !== false;
    }

    private function mac()
    {
        return strpos($this->device, self::MAC) !== false;
    }

    private function android()
    {
        return strpos($this->device, self::ANDROID) !== false;
    }

    private function windows()
    {
        return strpos($this->device, self::WINDOWS) !== false;
    }
}
