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
     * emailの形式が正しくない場合はエラーメッセージを返す
     * 正しければnullを返す
     *
     * @return string|null
     */
    public function isCorrectEmailFormat(): ?string
    {
        $pattern =
            "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
        return (!preg_match($pattern, $this->email)) ? self::ERROR_EMAIL_INVALID_FORMAT : null;
    }

    /**
     * emailの入力が空の場合はエラーメッセージを返す
     * 正しければnullを返す
     *
     * @return string|null
     */
    public function isNullEmailInputForm(): ?string
    {
        return (empty($this->email)) ? self::ERROR_EMAIL_NULL_TEXT : null;
    }

    /**
     * passwordの入力が空の場合はエラーメッセージを返す
     * 空じゃない場合はnullを返す
     *
     * @return string|null
     */
    public function isNullPasswordInputForm(): ?string
    {
        return (empty($this->password)) ? self::ERROR_PASSWORD_NULL_TEXT : null;
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
