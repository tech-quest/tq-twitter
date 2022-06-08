<?php

namespace App\Infrastructure\Validator;

use App\Domain\ValueObject\Password;

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

        if (!Password::isValid($this->password)) {
            return self::ERROR_EMAIL_PASSWORD_FORMAT;
        }

        return null;
    }
}
