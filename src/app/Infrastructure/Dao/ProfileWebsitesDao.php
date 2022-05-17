<?php

namespace App\Infrastructure\Dao;

use App\Infrastructure\Dao\Dao;
use App\Domain\ValueObject\UserId;
use PDO;

final class ProfileWebsitesDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 対象ユーザーのプロフィールウェブサイトを取得
     *
     * @param UserId $userId
     * @return array
     */
    public function findByUserId(UserId $userId): ?array
    {
        $sql = "
        SELECT 
            *
        FROM 
            profile_websites
        WHERE
            user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId->value(), PDO::PARAM_STR);
        $stmt->execute();

        $website = $stmt->fetch(PDO::FETCH_ASSOC);
        return $website === false ? null : $website;
    }
}
