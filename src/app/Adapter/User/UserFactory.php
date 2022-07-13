<?php

namespace App\Adapter\User\Query;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Name;


final class UserFactory
{
    public static function create(array $userMapper): User
    {
        return new User(
            new UserId($userMapper['id']),
            new Name($userMapper['name']),
            new Email($userMapper['email']),
            new Password($userMapper['password'])
        );
    }
}
