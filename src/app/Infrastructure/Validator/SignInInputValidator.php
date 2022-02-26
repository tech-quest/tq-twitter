<?php

namespace App\Infrastructure\Validator;

/**
 * ログインフォーム情報のバリでた
 */
final class SignInInputValidator
{
    private $email;

    /**
     * コンストラクタ
     *
     * @param ?string $email
     */
    public function __construct(?string $email)
    {
        $this->email = $email;
    }

    private function emailErrorText(): ?string
    {
        if (empty($this->email)) {
            return 'Emailが空です';
        }

        $pattern =
            "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
        if (preg_match($pattern, $this->email)) {
            return '不正な形式のメールアドレスです';
        }

        return null;
    }

    /**
     * 発生したエラ-メッセージを全件取得する
     *
     * @return array
     */
    public function allErrors(): array
    {
        $errors = [];
        $errors[] = $this->emailErrorText();
        return array_filter($errors);
    }
}
