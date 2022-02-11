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
            return SELF::IPHONE;
        }
        if ($this->iPad()) {
            return SELF::IPAD;
        }
        if ($this->mac()) {
            return SELF::MAC;
        }
        if ($this->android()) {
            return SELF::ANDROID;
        }
        if ($this->windows()) {
            return SELF::WINDOWS;
        }
    }

    private function iPhone()
    {
        return strpos($this->device, SELF::IPHONE) !== false &&
            strpos($this->device, SELF::MOBILE) !== false;
    }

    private function iPad()
    {
        return strpos($this->device, SELF::IPAD) !== false &&
            strpos($this->device, SELF::MOBILE) !== false;
    }

    private function mac()
    {
        return strpos($this->device, SELF::MAC) !== false;
    }

    private function android()
    {
        return strpos($this->device, SELF::ANDROID) !== false;
    }

    private function windows()
    {
        return strpos($this->device, SELF::WINDOWS) !== false;
    }
}
