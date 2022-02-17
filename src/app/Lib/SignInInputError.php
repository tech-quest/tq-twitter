<?php

namespace App\Lib;

/**
 * ログインフォーム用エラーメッセージオブジェクト
 */
final class SignInInputError
{
    private $email;
    private $password;

    /**
     * コンストラクタ
     *
     * @param ?string $email
     * @param ?string $password
     */
    public function __construct(?string $email, ?string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function password(): ?string
    {
        return $this->password;
    }

    /**
     * ログインできなかったときにエラーメッセージを返す
     *
     * @return array
     */
    public function outputAllMessage(): array
    {
        $messages = [];
        $messages[] = $this->email;
        $messages[] = $this->password;
        return array_filter($messages);
    }

    public function isEmpty(): bool
    {
        return is_null($this->email) && is_null($this->password);
    }
}
