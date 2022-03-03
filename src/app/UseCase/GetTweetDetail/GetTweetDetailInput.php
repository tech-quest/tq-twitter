<?php

namespace App\UseCase\GetTweetDetail;

use App\Domain\ValueObject\TweetId;

final class GetTweetDetailInput
{
    private $tweetId;

    public function __construct(TweetId $tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function tweetId(): TweetId
    {
        return $this->tweetId;
    }
}
