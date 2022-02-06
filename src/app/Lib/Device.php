<?php

namespace App\Lib;

final class Device
{
    private $device;

    public function __construct(string $device)
    {
        $this->device = $device;
    }

    public function tweetDevice()
    {
        if ($this->iPhone()) {
            return 'iPhone';
        }
        if ($this->iPad()) {
            return 'iPad';
        }
        if ($this->mac()) {
            return 'Mac';
        }
        if ($this->android()) {
            return 'Android';
        }
        if ($this->windows()) {
            return 'Win';
        }
    }

    private function iPhone()
    {
        return strpos($this->device, 'iPhone') !== false &&
            strpos($this->device, 'Mobile') !== false;
    }

    private function iPad()
    {
        return strpos($this->device, 'iPad') !== false &&
            strpos($this->device, 'Mobile') !== false;
    }

    private function mac()
    {
        return strpos($this->device, 'Mac') !== false;
    }

    private function android()
    {
        return strpos($this->device, 'Android') !== false;
    }

    private function windows()
    {
        return strpos($this->device, 'Windows') !== false;
    }
}
