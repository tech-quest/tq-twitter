<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Validator\SignInInputValidator;

class SignInInputValidatorTest extends TestCase
{
    /** @test */
    public function メールアドレスの形式が正しかったとき_nullを返す()
    {
        $signInInputValidator = new SignInInputValidator(
            'hoge-hoge@email.com',
            null
        );
        $actual = $signInInputValidator->isValidEmailFormat();
        $this->assertNull($actual);
    }

    /** @test */
    public function メールアドレスの形式が不正だったとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator('hogeemail.com', null);
        $actual = $signInInputValidator->isValidEmailFormat();
        $this->assertSame(
            $actual,
            SignInInputValidator::ERROR_EMAIL_INVALID_FORMAT
        );
    }

    /** @test */
    public function メールアドレスの入力フォームが空文字列のとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator('', null);
        $actual = $signInInputValidator->isEmptyEmailInputForm();
        $this->assertSame($actual, SignInInputValidator::ERROR_EMAIL_NULL_TEXT);
    }

    /** @test */
    public function メールアドレスの入力フォームがnullのとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator(null, null);
        $actual = $signInInputValidator->isEmptyEmailInputForm();
        $this->assertSame($actual, SignInInputValidator::ERROR_EMAIL_NULL_TEXT);
    }

    /** @test */
    public function メールアドレスの入力が0のとき_nullを返す()
    {
        $signInInputValidator = new SignInInputValidator(0, null);
        $actual = $signInInputValidator->isEmptyEmailInputForm();
        $this->assertNull($actual);
    }

    /** @test */
    public function パスワードの入力が空文字列のとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator(null, '');
        $actual = $signInInputValidator->isEmptyPasswordInputForm();
        $this->assertSame(
            $actual,
            SignInInputValidator::ERROR_PASSWORD_NULL_TEXT
        );
    }

    /** @test */
    public function パスワードの入力がnullのとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator(null, null);
        $actual = $signInInputValidator->isEmptyPasswordInputForm();
        $this->assertSame(
            $actual,
            SignInInputValidator::ERROR_PASSWORD_NULL_TEXT
        );
    }

    /** @test */
    public function パスワードの入力が0のとき_nullを返す()
    {
        $signInInputValidator = new SignInInputValidator(null, 0);
        $actual = $signInInputValidator->isEmptyPasswordInputForm();
        $this->assertNull($actual);
    }
}
