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
        $actual = $signInInputValidator->isCorrectEmailFormat();
        $this->assertEmpty($actual);
    }

    /** @test */
    public function メールアドレスの形式が不正だったとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator('hoge@email.com', null);
        $actual = $signInInputValidator->isCorrectEmailFormat();
        $this->assertEmpty($actual);
    }

    /** @test */
    public function メールアドレスの入力フォームが空のとき_エラーメッセージを返す()
    {
        $signInInputValidator = new SignInInputValidator('hoge@email.com', null);
        $actual = $signInInputValidator->isNullEmailInputForm();
        $this->assertEmpty($actual);
    }

    /** @test */
    public function パスワードの入力フォームが空のとき_エラーメッセージを返す()
    {

        $signInInputValidator = new SignInInputValidator('hoge-hoge@email.com', 'password');

        $actual = $signInInputValidator->isNullPasswordInputForm();
        $this->assertEmpty($actual);
    }
}
