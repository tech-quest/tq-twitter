<?php

namespace App\UseCase\GetTweetDetail;

use App\Domain\Entity\Tweet;

final class GetTweetDetailOutput
{
    private $tweet;

    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function tweet(): Tweet
    {
        return $this->tweet;
    }
}
