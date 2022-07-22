<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Validator\SignInInputValidator;

class SignInInputValidatorTest extends TestCase
{
    /** @test */
    public function メールアドレスとパスワードが正しかったとき_空配列が返ること()
    {

        $signInInputValidator = new SignInInputValidator(
            'hoge-hoge@email.com',
            'Aa111111'
        );
        $actual = $signInInputValidator->allErrors();

        $this->assertEmpty($actual);
    }

    /** @test */
    public function メールアドレスが空の時_想定するエラーメッセージが配列に含まれていること()
    {
        $signInInputValidator = new SignInInputValidator('', 'Aa111111');
        $actual = $signInInputValidator->allErrors();

        $this->assertContains(
            SignInInputValidator::ERROR_EMAIL_NULL_TEXT,
            $actual
        );
    }

    /** @test */
    public function メールアドレスの形式が不正だった時_想定するエラーメッセージが配列に含まれていること()
    {
        $signInInputValidator = new SignInInputValidator('a', 'Aa111111');
        $actual = $signInInputValidator->allErrors();

        $this->assertContains(
            SignInInputValidator::ERROR_EMAIL_INVALID_FORMAT,
            $actual
        );
    }

    /** @test */
    public function パスワードが空の時_想定するエラーメッセージが配列に含まれていること()
    {
        $signInInputValidator = new SignInInputValidator('hoge-hoge@email.com', '');
        $actual = $signInInputValidator->allErrors();

        $this->assertContains(
            SignInInputValidator::ERROR_PASSWORD_NULL_TEXT,
            $actual
        );
    }

    /** @test */
    public function パスワードの形式が不正だった時_想定するエラーメッセージが配列に含まれていること()
    {
        $signInInputValidator = new SignInInputValidator('hoge-hoge@email.com', '111111');
        $actual = $signInInputValidator->allErrors();

        $this->assertContains(
            SignInInputValidator::ERROR_PASSWORD_INVALID_FORMAT,
            $actual
        );
    }
}
