<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Password;

class PasswordTest extends TestCase
{
    /** @test */
    public function パスワードが8文字かつ大小の英数字で構成させているとき_trueになること()
    {
        $password = "Pass0001";
        $actual = Password::isValid($password);
        $this->assertTrue($actual);
    }

    /** @test */
    public function パスワードが24文字かつ大小の英数字で構成させているとき_trueになること()
    {
        $password = "Pass0001Pass0001Pass0001";
        $actual = Password::isValid($password);
        $this->assertTrue($actual);
    }

    /** @test */
    public function パスワードが7文字かつ大小の英数字で構成させているとき_falseになること()
    {
        $password = "Pass000";
        $actual = Password::isValid($password);
        $this->assertFalse($actual);
    }

    /** @test */
    public function パスワードが25文字かつ大小の英数字で構成させているとき_falseになること()
    {
        $password = "Pass0001Pass0001Pass00011";
        $actual = Password::isValid($password);
        $this->assertFalse($actual);
    }

    /** @test */
    public function パスワードが8文字かつ小文字の英字だけで構成されているとき_falseになること()
    {
        $password = "password";
        $actual = Password::isValid($password);
        $this->assertFalse($actual);
    }

    /** @test */
    public function パスワードが8文字かつ大文字の英字だけで構成されているとき_falseになること()
    {
        $password = "PASSWORD";
        $actual = Password::isValid($password);
        $this->assertFalse($actual);
    }

    /** @test */
    public function パスワードが8文字かつ数字だけで構成されているとき_falseになること()
    {
        $password = "12345678";
        $actual = Password::isValid($password);
        $this->assertFalse($actual);
    }
}
