<?php

namespace App\Infrastructure\Validator;

/**
 * パスワード入力フォーム情報のバリデーター
 */
final class PasswordInputValidator
{

    public const ERROR_PASSWORD_NULL_TEXT = 'passwordが空です';
    public const ERROR_EMAIL_PASSWORD_FORMAT = '不正な形式のパスワードです';

    private $password;

    /**
     * コンストラクタ
     *
     * @param string|null $password
     */
    public function __construct(?string $password)
    {
        $this->password = $password;
    }

    /**
     * passwordがnullでないか形式が正しいかのチェック
     *
     * @return string|null
     */
    public function passwordErrorText(): ?string
    {
        if (empty($this->password)) {
            return self::ERROR_PASSWORD_NULL_TEXT;
        }

        $pattern = '/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/';
        if (!preg_match($pattern, $this->password)) {
            return self::ERROR_EMAIL_PASSWORD_FORMAT;
        }

        return null;
    }
}
