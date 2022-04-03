<?php

namespace App\Lib;

use App\Domain\ValueObject\AuthUser;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\UserID;

final class Session
{
    public const AUTH_KEY = 'auth';
    public const ERRORS_KEY = 'errors';
    public const CERTIFICATE_EMAIL_KEY = 'certificate_email';
    public const CERTIFICATE_REGISTER_EMAIL_KEY = 'certificate_register_email';
    public const USER_KEY = 'user_id';
    public const NAME_KEY = 'name';
    public const HASH_CERTIFICATE_REGISTER = 'hash_certificate_register';

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

    public function setCertificateEmail(Email $email): void
    {
        $_SESSION[self::CERTIFICATE_EMAIL_KEY] = $email->value();
    }

    public function setHashCertificateEmail(string $hashCertificationCode): void
    {
        $_SESSION[self::HASH_CERTIFICATE_REGISTER] = $hashCertificationCode;
    }

    public function setRegisterCertificateEmail(Email $email): void
    {
        $_SESSION[self::CERTIFICATE_REGISTER_EMAIL_KEY] = $email->value();
    }

    public function setUserId(UserID $userId): void
    {
        $_SESSION[self::USER_KEY] = $userId->value();
    }

    public function certificateEmail(): Email
    {
        if (isset($_SESSION[self::CERTIFICATE_EMAIL_KEY])) {
            throw new Exception('認証用メールアドレスが保存されてません');
        }
        return new Email($_SESSION[self::CERTIFICATE_EMAIL_KEY]);
    }
}
