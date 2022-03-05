<?php

namespace App\UseCase\SearchTweets;
use App\Adapter\QueryService\TweetQueryService;

interface SearchTweets
{
    public function __construct(
        SearchTweetsInput $input,
        TweetQueryService $tweetQueryService
    );
    public function handler(): SearchTweetsOutput;
}
