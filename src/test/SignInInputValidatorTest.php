<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Validator\SignInInputValidator;

class SignInInputValidatorTest extends TestCase
{
    /** @test */
    public function メールアドレスが正しかったとき()
    {
        $signInInputValidator = new SignInInputValidator(
            'hoge-hoge@email.com',
            ''
        );
        $actual = $signInInputValidator->allErrors();

        $this->assertNull($actual[0]);
    }

    public function メールアドレスが空の時のテスト()
    {
        $signInInputValidator = new SignInInputValidator('');
        $actual = $signInInputValidator->allErrors();

        $this->assertSame(
            SignInInputValidator::ERROR_EMAIL_NULL_TEXT,
            $actual[0]
        );
    }

    public function メールアドレスの形式が不正だった時のテスト()
    {
        $signInInputValidator = new SignInInputValidator('a');
        $actual = $signInInputValidator->allErrors();

        $this->assertSame(
            SignInInputValidator::ERROR_EMAIL_INVALID_FORMAT,
            $actual[0]
        );
    }
}
