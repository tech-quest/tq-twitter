<?php

namespace App\Infrastructure\Validator;

use function PHPUnit\Framework\isNull;
use App\Domain\ValueObject\Email;

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
     * emailの形式が正しければnullを返す
     * 正しくない場合はエラーメッセージを返す
     *
     * @return string|null
     */
    public function isValidEmailFormat(): ?string
    {
        return Email::isValid($this->email)
            ? null
            : self::ERROR_EMAIL_INVALID_FORMAT;
    }

    /**
     * emailの入力がnullまたは空文字列の場合はエラーメッセージを返す
     * 正しい場合はnullを返す
     *
     * @return string|null
     */
    public function isEmptyEmailInputForm(): ?string
    {
        return is_null($this->email) || $this->email === ''
            ? self::ERROR_EMAIL_NULL_TEXT
            : null;
    }

    /**
     * passwordの入力がnullまたは空文字列の場合はエラーメッセージを返す
     * 正しい場合はnullを返す
     *
     * @return string|null
     */
    public function isEmptyPasswordInputForm(): ?string
    {
        return is_null($this->password) || $this->password === ''
            ? self::ERROR_PASSWORD_NULL_TEXT
            : null;
    }

    /**
     * 発生したエラ-メッセージを全件取得する
     *
     * @return array
     */
    public function allErrors(): array
    {
        $errors = [
            $this->isValidEmailFormat(),
            $this->isEmptyEmailInputForm(),
            $this->isEmptyPasswordInputForm(),
        ];
        return array_filter($errors);
    }
}
