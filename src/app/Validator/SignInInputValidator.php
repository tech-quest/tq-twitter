<?php

namespace App\Validator;

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

        // TODO: メルアドの書式かチェックする処理

        return null;
    }

    /**
     * 発生したエラメッセ時を全件取得する
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
