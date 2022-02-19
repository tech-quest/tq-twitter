<?php

namespace App\Lib;

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

    /**
     * セッションが開始されていなかったら開始する
     *
     * @return void
     */
    private static function start(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * ログインユーザーの情報をセッションに登録する
     *
     * @param AuthUser $authUser
     * @return void
     */
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

    /**
     * エラー情報をセッションに登録する
     *
     * @param array $errors
     * @return void
     */
    public function setErrors(array $errors): void
    {
        $_SESSION[self::ERRORS_KEY] = $errors;
    }

    /**
     * セッションに保存したエラー情報を返す
     * 存在しなければnullを返す
     * @return array
     */
    public function errors(): array
    {
        return $_SESSION[self::ERRORS_KEY] ?? [];
    }

    /**
     * セッション情報を破棄する
     *
     * @return void
     */
    public function clearErrors(): void
    {
        unset($_SESSION[self::ERRORS_KEY]);
    }
}
