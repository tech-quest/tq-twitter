<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\UseCase\Signin\SignInInteractor;
use App\UseCase\Signin\SignInInput;
use App\Domain\Adapter\UserQueryServiceInterface;
use PHPUnit\Framework\TestCase;

final class SigninTest extends TestCase
{
    /** @test */
    public function ユーザーが存在するかつメールアドレスとパスワードが正しかったとき_isSuccessがtrueかつログインメッセージが返ること()
    {
        $useCaseInput = new SignInInput(
            new Email('hogehoge@gmail.com'),
            new Password('Aa11111a')
        );

        $signinInteractor = new SignInInteractor(
            $useCaseInput,
            new class implements UserQueryServiceInterface
            {
                public function findByEmail(Email $email): ?User
                {
                    $passwordHash = password_hash('Aa11111a', PASSWORD_DEFAULT);
                    return new User(
                        new UserId(1),
                        new Name('hoge'),
                        new Email('hogehoge@gmail.com'),
                        new Password($passwordHash)
                    );
                }

                public function findById(UserId $id): ?User
                {
                    return null;
                }
            }
        );

        $signinOutput = $signinInteractor->handler();
        $expected = 'ログインしました';
        $this->assertTrue($signinOutput->isSuccess());
        $this->assertSame($expected, $signinOutput->message());
    }

    /** @test */
    public function パスワードが誤っているとき_isSuccessがfalseかつエラーメッセージが返ること()
    {
        $useCaseInput = new SignInInput(
            new Email('hogehoge@gmail.com'),
            new Password('Aa11111')
        );

        $signinInteractor = new SignInInteractor(
            $useCaseInput,
            new class implements UserQueryServiceInterface
            {
                public function findByEmail(Email $email): ?User
                {
                    $passwordHash = password_hash('Aa11111a', PASSWORD_DEFAULT);
                    return new User(
                        new UserId(1),
                        new Name('hoge'),
                        new Email('hogehoge@gmail.com'),
                        new Password($passwordHash)
                    );
                }

                public function findById(UserId $id): ?User
                {
                    return null;
                }
            }
        );

        $signinOutput = $signinInteractor->handler();
        $expected = 'メールアドレスまたは<br />パスワードが間違っています';
        $this->assertFalse($signinOutput->isSuccess());
        $this->assertSame($expected, $signinOutput->message());
    }

    /** @test */
    public function ユーザーが存在しなかったとき_isSuccessがfalseかつエラーメッセージが返ること()
    {
        $useCaseInput = new SignInInput(
            new Email('hogehoge@gmail.com'),
            new Password('Aa11111a')
        );

        $signinInteractor = new SignInInteractor(
            $useCaseInput,
            new class implements UserQueryServiceInterface
            {
                public function findByEmail(Email $email): ?User
                {
                    return null;
                }

                public function findById(UserId $id): ?User
                {
                    return null;
                }
            }
        );

        $signinOutput = $signinInteractor->handler();
        $expected = 'メールアドレスまたは<br />パスワードが間違っています';
        $this->assertFalse($signinOutput->isSuccess());
        $this->assertSame($expected, $signinOutput->message());
    }
}
