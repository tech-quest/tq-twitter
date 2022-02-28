<?php

namespace App\Infrastructure\Validator;

/**
 * ログインフォーム情報のバリデーター
 */
final class SignInInputValidator
{
    public const ERROR_EMAIL_INVALID_FORMAT = '不正な形式のメールアドレスです';
    public const ERROR_EMAIL_NULL_TEXT = 'Emailが空です';
    public const ERROR_PASSWORD_NULL_TEXT = 'passwordが空です';

    private $email;
    private $password;

    /**
     * コンストラクタ
     *
     * @param string|null $email
     * @param string|null $password
     */
    public function __construct(?string $email, ?string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * emailがnullでないか、形式が正しいかのチェック
     *
     * @return string|null
     */
    private function emailErrorText(): ?string
    {
        if (empty($this->email)) {
            return self::ERROR_EMAIL_NULL_TEXT;
        }

        $pattern =
            "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
        if (!preg_match($pattern, $this->email)) {
            return self::ERROR_EMAIL_INVALID_FORMAT;
        }

        return null;
    }

    /**
     * passwordがnullでないかのチェック
     *
     * @return void
     */
    private function passwordErrorText()
    {
        if (empty($this->password)) {
            return self::ERROR_PASSWORD_NULL_TEXT;
        }
    }

    /**
     * 発生したエラ-メッセージを全件取得する
     *
     * @return array
     */
    public function allErrors(): array
    {
        $errors = [$this->emailErrorText(), $this->passwordErrorText()];
        return array_filter($errors);
    }
}
