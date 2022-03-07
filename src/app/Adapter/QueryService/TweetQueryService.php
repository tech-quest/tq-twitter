<?php
namespace App\Adapter\QueryService;

use App\Infrastructure\Dao\TweetDao;
use App\Domain\Entity\Tweet;
use App\Domain\ValueObject\TweetId;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\TweetBody;
use App\Domain\ValueObject\ReplyTweetId;
use App\Domain\ValueObject\TweetDevice;
use App\Domain\ValueObject\TweetDate;

final class TweetQueryService
{
    private $tweetDao;

    public function __construct()
    {
        $this->tweetDao = new TweetDao();
    }

    public function findById(TweetId $id): Tweet
    {
        $tweetMapper = $this->tweetDao->findById($id->value());

        return new Tweet(
            new TweetId($tweetMapper['id']),
            new UserId($tweetMapper['user_id']),
            new TweetBody($tweetMapper['tweet']),
            new ReplyTweetId($tweetMapper['reply_tweet_id']),
            new TweetDevice($tweetMapper['device']),
            new TweetDate($tweetMapper['created_at'])
        );
    }
}
