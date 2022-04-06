<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /** @test */
    public function 変更したパスワードが正しかったとき()
    {
        $hash = '$2y$10$DfrVWNmNZB2g/nO.8dcnUuj7Br54gaW4u9lv0u.sDJGI02Iiu/EC2';
        $actual = '00000000';
        $expected = password_verify($actual, $hash);

        $this->assertSame($expected, true);
    }
}
