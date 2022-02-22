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

    /**
     * ツイートの追加
     *
     * @param integer $user_id
     * @param string $tweet
     * @param integer $replyTweetId
     * @param string $device
     * @return void
     */
    public function insert(
        int $user_id,
        string $tweet,
        int $replyTweetId,
        string $device
    ) {
        $sql = <<<EOF
        INSERT INTO 
            tweets 
        (user_id, tweet, reply_tweet_id, device)
        VALUES
        (:user_id, :tweet, :reply_tweet_id, :device)
EOF;

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':tweet', $tweet, PDO::PARAM_STR);
        $stmt->bindValue(':reply_tweet_id', $replyTweetId, PDO::PARAM_INT);
        $stmt->bindValue(':device', $device, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * ツイートの全件取得
     *
     * @return void
     */
    public function findAllByTweets(): array
    {
        $sql = <<<EOF
        SELECT
            *
        FROM
            tweets
        ORDER BY
          id DESC
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

    public function findById(int $id, int $user_id): array
    {
        $sql = <<<EOF
		    SELECT
          *
		    FROM
        	  tweets
      	WHERE
        	  id = :id
      	AND
        	  user_id = :user_id
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $tweet = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tweet;
    }
}
