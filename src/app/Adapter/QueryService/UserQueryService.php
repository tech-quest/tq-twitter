<?php

namespace App\Adapter\QueryService;

use App\Domain\Entity\User;
use App\Infrastructure\Dao\UserDao;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\Adapter\UserQueryServiceInterface;

final class UserQueryService implements UserQueryServiceInterface
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function findById(UserId $id): ?User
    {
        $userMapper = $this->userDao->findById($id->value());

        if (is_null($userMapper)) {
            return null;
        }

        return new User(
            new UserId($userMapper['id']),
            new Name($userMapper['name']),
            new Email($userMapper['email']),
            new Password($userMapper['password'])
        );
    }

    public function findByEmail(Email $email): ?User
    {
        $userMapper = $this->userDao->findByEmail($email->value());

        return is_null($userMapper)
            ? null
            : new User(
                new UserId($userMapper['id']),
                new Name($userMapper['name']),
                new Email($userMapper['email']),
                new Password($userMapper['password'])
            );
    }
}
