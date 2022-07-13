<?php

namespace App\UseCase\Signin;

use App\UseCase\Signin\SignInInput;
use App\UseCase\Signin\SignInOutput;
use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\AuthUser;
use App\Lib\Session;
use App\Domain\Adapter\UserQueryServiceInterface;

/**
 * ログインユースケース
 */
final class SignInInteractor
{
    /**
     * ログイン失敗時のエラーメッセージ
     */
    const FAILED_MESSAGE = 'メールアドレスまたは<br />パスワードが間違っています';

    /**
     * ログイン成功時のメッセージ
     */
    const SUCCESS_MESSAGE = 'ログインしました';

    /**
     * @var SignInInput
     */
    private $input;

    /**
     * @var UserQueryServiceInterface
     */
    private $userQuery;

    /**
     * コンストラクタ
     *
     * @param SignInInput $input
     */
    public function __construct(SignInInput $input, UserQueryServiceInterface $userQuery)
    {
        $this->userQuery = $userQuery;
        $this->input = $input;
    }

    /**
     * ログイン処理
     * セッションへのユーザー情報の保存も行う
     *
     * @return SignInOutput
     */
    public function handler(): SignInOutput
    {
        $user = $this->userQuery->findByEmail($this->input->email());

        if (is_null($user)) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        if ($this->isInvalidPassword($user->password())) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        $this->saveSession($user);

        return new SignInOutput(true, self::SUCCESS_MESSAGE);
    }

    /**
     * パスワードが正しいかどうか
     *
     * @param Password $password
     * @return boolean
     */
    private function isInvalidPassword(Password $password): bool
    {
        $thisPassword = $this->input->password();
        $inputPassword = $thisPassword->value();

        return !password_verify($inputPassword, $password->value());
    }

    /**
     * セッションの保存処理
     *
     * @param User $user
     * @return void
     */
    private function saveSession(User $user): void
    {
        $userId = $user->id();
        $userName = $user->name();
        $userEmail = $user->email();

        $authUser = new AuthUser(
            new UserId($userId->value()),
            new Name($userName->value()),
            new Email($userEmail->value())
        );
        $session = new Session();
        $session->setAuth($authUser);
    }
}
