<?php
namespace App\Dao;

use App\Dao\Dao;
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
        (user_id, tweet, reply_tweet_Id, device)
        VALUES
        (:user_id, :tweet, :reply_tweet_Id, :device)
EOF;

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':tweet', $tweet, PDO::PARAM_STR);
        $stmt->bindValue(':reply_tweet_Id', $replyTweetId, PDO::PARAM_INT);
        $stmt->bindValue(':device', $device, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function findByAllTweets(): array
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

    public function findById($id, $user_id)
    {
        $sql = <<<EOF
		    SELECT
			    tweet,
			    device,
			    created_at
		    FROM
        	  tweets
      	WHERE
        	  id = :id
      	AND
        	  user_id = :user_id
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        $tweet = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tweet;
    }
}
