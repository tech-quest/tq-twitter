<?php

namespace App\Adapter\User\Query;

use App\Domain\Entity\User;
use App\Infrastructure\Dao\UserDao;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;
use App\Domain\Adapter\UserQueryServiceInterface;
use App\Adapter\User\UserFactory;

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

        return UserFactory::create($userMapper);
    }

    public function findByEmail(Email $email): ?User
    {
        $userMapper = $this->userDao->findByEmail($email->value());

        return is_null($userMapper)
            ? null
            : UserFactory::create($userMapper);
    }
}
