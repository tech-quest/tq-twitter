<?php

namespace App\Lib;

use App\Lib\SignInInputError;

final class Session
{
    private static $instance;

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        self::start();

        return self::$instance;
    }

    private static function start(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function setAuth(int $id, string $name): void
    {
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
    }

    /**
     * $_SESSION['errors']にログイン時のエラーメッセージをセットしている
     * $_SESSION['formInputs']にログイン入力フォームに表示させるemailをセットしている
     *
     * @param SignInInputError $signInInputError
     * @param string $email
     * @return void
     */
    public function setSignInInputErrorMessages(
        SignInInputError $signInInputError,
        string $email
    ): void {
        $_SESSION['errors'] = $signInInputError;
        $_SESSION['formInputs'] = [
            'email' => $email,
        ];
    }
}
