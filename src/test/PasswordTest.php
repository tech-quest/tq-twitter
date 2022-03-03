<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /** @test */
    public function 変更したパスワードが正しかったとき()
    {
        $hash = '$2y$10$A4p0zGPHchy2IKV/d54vOuNG8suG..PzazE0hW.R64sKqRcOpSvii';
        $actual = 88888888;
        $expected = password_verify($actual, $hash);

        $this->assertSame($expected, true);
    }
}
