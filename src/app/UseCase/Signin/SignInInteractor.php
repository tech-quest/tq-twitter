<?php
namespace App\UseCase\Signin;

use App\Infrastructure\Dao\UserDao;
use App\UseCase\Signin\SignInInput;
use App\UseCase\Signin\SignInOutput;
use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\AuthUser;
use App\Lib\Session;

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
     * @var UserDao
     */
    private $userDao;

    /**
     * コンストラクタ
     *
     * @param SignInInput $input
     */
    public function __construct(SignInInput $input)
    {
        $this->userDao = new UserDao();
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
        $user = $this->findUser();

        if ($this->notExistsUser($user)) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        if ($this->isInvalidPassword($user->password())) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        $this->saveSession($user);

        return new SignInOutput(true, self::SUCCESS_MESSAGE);
    }

    /**
     *
     *
     * @return array | null
     */
    private function findUser(): ?User
    {
        $email = $this->input->email();
        $userMapper = $this->userDao->findByEmail($email->value());

        return $this->isExistsUser($userMapper)
            ? null
            : new User(
                new UserId($userMapper['id']),
                new Name($userMapper['name']),
                new Email($userMapper['email']),
                new Password($userMapper['password'])
            );
    }

    private function isExistsUser(?array $user): bool
    {
        return is_null($user);
    }

    /**
     * ユーザーが存在しない場合
     *
     * @param array|null $user
     * @return boolean
     */
    private function notExistsUser(?User $user): bool
    {
        return is_null($user);
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
        $userPassword = $user->password();

        $authUser = new AuthUser(
            new UserId($userId->value()),
            new Name($userName->value()),
            new Email($userEmail->value())
        );
        $session = new Session();
        $session->setAuth($authUser);
    }
}
