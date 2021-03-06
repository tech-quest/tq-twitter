<?php

namespace App\Infrastructure\Dao;

use App\Infrastructure\Dao\Dao;
use PDO;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserId;

final class UserDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertUser(string $name, string $email, string $password): bool
    {
        $sql = <<<EOF
    INSERT INTO users
    (name, email, password)
    VALUES
    (:name, :email, :password)
EOF;

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findById(int $id): ?array
    {
        $sql = "
        SELECT 
            *
        FROM 
            users
        WHERE
            id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $res = $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return empty($user) ? null : $user;
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
}
