<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Lib\Device;

class DeviceTest extends TestCase
{
    /** @test */
    public function mac()
    {
        $device = new Device(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3864.0 Safari/537.36'
        );
        $actual = $device->tweetDevice();
        $expected = 'Mac';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function windows()
    {
        $device = new Device(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'
        );
        $actual = $device->tweetDevice();
        $expected = 'Win';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function iPhone()
    {
        $device = new Device(
            'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'
        );
        $actual = $device->tweetDevice();
        $expected = 'iPhone';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function iPad()
    {
        $device = new Device(
            'Mozilla/5.0 (iPad; CPU iPad OS 11_0 like OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'
        );
        $actual = $device->tweetDevice();
        $expected = 'iPad';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function win()
    {
        $device = new Device(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'
        );
        $actual = $device->tweetDevice();
        $expected = 'Win';

        $this->assertSame($expected, $actual);
    }
}
