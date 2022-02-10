<?php
namespace App\Dao;

use App\Dao\Dao;
use App\ValueObject\UserId;
use PDO;

final class TweetDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(
        int $user_id,
        string $tweet,
        int $replyTweetId,
        string $device
    ) {
        $sql = <<<EOF
        INSERT INTO 
            tweets 
        (user_id, tweet, reply_Tweet_Id, device)
        VALUES
        (:user_id, :tweet, :reply_Tweet_Id, :device)
EOF;

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':tweet', $tweet, PDO::PARAM_STR);
        $stmt->bindValue(':reply_Tweet_Id', $replyTweetId, PDO::PARAM_INT);
        $stmt->bindValue(':device', $device, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function findByAllTweets()
    {
        $sql = <<<EOF
        SELECT
            *
        FROM
            tweets
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tweets;
    }

    /**
     * 対象ユーザーのツイートを全件取得
     *
     * @param UserId $userId
     * @return array
     */
    public function findAllByUserId(UserId $userId): array
    {
        $sql = "
        SELECT 
            *
        FROM 
            tweets
        WHERE
            user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId->value(), PDO::PARAM_STR);
        $stmt->execute();

        $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return empty($tweets) ? [] : $tweets;
    }
}
