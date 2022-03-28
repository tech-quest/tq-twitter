<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /** @test */
    public function 変更したパスワードが正しかったとき()
    {
        $hash = '$2y$10$nyKSPZJ7qdfy2jl2NZwo0.b8wZdj3tGYYTpmaL1wCbs79JaIurseK';
        $actual = 12345678;
        $expected = password_verify($actual, $hash);

        $this->assertSame($expected, true);
    }
}
