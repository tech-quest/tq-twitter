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
}
