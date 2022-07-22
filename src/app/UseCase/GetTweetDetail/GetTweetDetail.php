<?php

namespace App\UseCase\GetTweetDetail;

use App\Domain\Adapter\TweetQueryServiceInterface;

interface GetTweetDetail
{
    public function __construct(GetTweetDetailInput $input, TweetQueryServiceInterface $tweetQuery);
    public function handler(): GetTweetDetailOutput;
}
