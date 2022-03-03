<?php

namespace App\Repository;

use DateTime;
use App\Dao\TweetDao;
use App\Entity\Tweet;
use App\ValueObject\UserId;
use App\ValueObject\TweetId;
use App\ValueObject\ReplyTweetId;
use App\ValueObject\SearchTweetCondition;

/**
 * ツイートのリポジトリ
 */
final class TweetRepository
{
    /**
     * ツイートテーブルとやりとりするDAO
     *
     * @var TweetDao
     */
    private $tweetDao;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->tweetDao = new TweetDao();
    }

    /**
     * ツイートの全件取得
     *
     * @return array
     */
    public function findAllByUserId(UserId $userId): array
    {
        $tweets = $this->tweetDao->findAllByUserId($userId);
        $tweetEntityes = [];

        foreach ($tweets as $tweet) {
            $tweetEntities[] = new Tweet(
                new TweetId($tweet['id']),
                new UserId($tweet['user_id']),
                $tweet['tweet'],
                new ReplyTweetId($tweet['reply_tweet_id']),
                $tweet['device'],
                new DateTime($tweet['deleted_at'])
            );
        }
        return $tweetEntityes;
    }
}
