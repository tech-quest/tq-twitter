<?php

namespace App\Lib;

use App\Domain\ValueObject\AuthUser;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Device;
use Exception;

final class Session
{
    public const AUTH_KEY = 'auth';
    public const ERRORS_KEY = 'errors';
    public const CERTIFICATE_EMAIL_KEY = 'certificate_email';
    public const CERTIFICATE_REGISTER_EMAIL_KEY = 'certificate_register_email';
    public const USER_KEY = 'user_id';
    public const NAME_KEY = 'name';
    public const EMAIL_KEY = 'email';
    public const INPUT_EMAIL_KEY = 'input_email';
    public const HASH_CERTIFICATE_REGISTER = 'hash_certificate_register';
    public const PASSWORD_CERTIFICATION_CODE = 'password_certification_code';
    public const DEVICE_KEY = 'device';
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

    public function clearInputEmail(): void
    {
        unset($_SESSION[self::INPUT_EMAIL_KEY]);
    }

    public function destroy(): void
    {
        $_SESSION = [];
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 4200, '/');
        }
        session_destroy();
    }

    public function setCertificateEmail(Email $email): void
    {
        $_SESSION[self::CERTIFICATE_EMAIL_KEY] = $email;
    }

    public function setHashCertificateEmail(string $hashCertificationCode): void
    {
        $_SESSION[self::HASH_CERTIFICATE_REGISTER] = $hashCertificationCode;
    }

    public function setPasswordCertificationCode(string $certificationCode): void
    {
        $_SESSION[self::PASSWORD_CERTIFICATION_CODE] = $certificationCode;
    }

    public function setRegisterCertificateEmail(Email $email): void
    {
        $_SESSION[self::CERTIFICATE_REGISTER_EMAIL_KEY] = $email->value();
    }

    public function setUserId(UserId $userId): void
    {
        $_SESSION[self::USER_KEY] = $userId->value();
    }

    public function setUserName(Name $name): void
    {
        $_SESSION[self::NAME_KEY] = $name->value();
    }

    public function setUserEmail(Email $email): void
    {
        $_SESSION[self::EMAIL_KEY] = $email->value();
    }

    public function inputEmail(): ?string
    {
        return $_SESSION[self::INPUT_EMAIL_KEY] ?? null;
    }

    public function setInputEmail(string $email): void
    {
        $_SESSION[self::INPUT_EMAIL_KEY] = $email;
    }

    public function setDevice(Device $device): void
    {
        $_SESSION[self::DEVICE_KEY] = $device->tweetDevice();
    }

    public function certificateEmail(): Email
    {
        if (!isset($_SESSION[self::CERTIFICATE_EMAIL_KEY])) {
            throw new Exception('認証用メールアドレスが保存されてません');
        }
        return $_SESSION[self::CERTIFICATE_EMAIL_KEY];
    }

    public function passwordCertificationCode(): string
    {
        if (!isset($_SESSION[self::PASSWORD_CERTIFICATION_CODE])) {
            throw new Exception('認証コードが保存されてません');
        }
        return $_SESSION[self::PASSWORD_CERTIFICATION_CODE];
    }
}
