<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /** @test */
    public function 変更したパスワードが正しかったとき()
    {
        $hash = '$2y$10$syGKwe7d5YH4aKoiCMKki.CWBqZkwSfyyqPDftVr1Xh/MBhnC.yFq';
        $actual = 666666;
        $expected = password_verify($actual, $hash);

        $this->assertSame($expected, true);
    }
}
