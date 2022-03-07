<?php

namespace App\Infrastructure\Dao;

use App\Infrastructure\Dao\Dao;
use PDO;
use App\Domain\ValueObject\Email;

final class UserDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "
        SELECT 
            *
        FROM 
            users
        WHERE
            email = :email";

        $stmt = $this->pdo->prepare($sql);

        $emailObject = new Email($email);
        $stmt->bindValue(':email', $emailObject->value(), PDO::PARAM_STR);

        $res = $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return empty($user) ? null : $user;
    }

    public function updatePassword(int $id, string $passwordHash)
    {
        $sql = <<<EOF
        UPDATE
          users
        SET
          password = :password
        WHERE
          id = :id
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':password', $passwordHash);
        return $stmt->execute();
    }

    /**
     *テストで使用予定
     *
     */
    public function getPassword()
    {
        $sql = <<<EOF
        SELECT
          *
        FROM
          users
        Where
          id = 8
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}
