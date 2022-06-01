<?php
namespace App\UseCase\Signin;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;

/**
 * ログインユースケースの入力値
 */
final class SignInInput
{
    /**
     * @var Email
     */
    private $email;

    /**
     * @var Password
     */
    private $password;

    /**
     * コンストラクタ
     *
     * @param Email $email
     * @param Password $password
     */
    public function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return Password
     */
    public function password(): Password
    {
        return $this->password;
    }
}
