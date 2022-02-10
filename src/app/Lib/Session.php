<?php

namespace App\Lib;

use App\Lib\SignInInputError;
use App\ValueObject\AuthUser;

final class Session
{
    public const AUTH_KEY = 'auth';
    public const ERRORS_KEY = 'errors';

    private static $instance;

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        self::start();

        return self::$instance;
    }

    private static function start(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function setAuth(AuthUser $authUser): void
    {
        $_SESSION[self::AUTH_KEY] = $authUser;
    }

    /**
     * セッションに保存したユーザー情報を取得する
     * 存在しなければnullを返す
     */
    public function auth(): ?AuthUser
    {
        return $_SESSION[self::AUTH_KEY] ?? null;
    }

    public function setErrors(array $errors): void
    {
        $_SESSION[self::ERRORS_KEY] = $errors;
    }

    public function errors(): array
    {
        return $_SESSION[self::ERRORS_KEY] ?? [];
    }

    public function clearErrors(): void
    {
        unset($_SESSION[self::ERRORS_KEY]);
    }

    /**
     * $_SESSION['errors']にログイン時のエラーメッセージをセットしている
     * $_SESSION['formInputs']にログイン入力フォームに表示させるemailをセットしている
     *

     * @param SignInInputError $signInInputError
     * @param string $email
     * @return void
     */
    public function setSignInInputErrorMessages(
        SignInInputError $signInInputError,
        string $email
    ): void {
        $_SESSION['errors'] = $signInInputError;
        $_SESSION['formInputs'] = [
            'email' => $email,
        ];
    }
}
