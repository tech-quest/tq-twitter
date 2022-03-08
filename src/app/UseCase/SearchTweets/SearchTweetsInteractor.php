<?php

namespace App\UseCase\SearchTweets;

use App\Adapter\QueryService\TweetQueryService;
use App\UseCase\SearchTweets\SearchTweetsInput;
use App\UseCase\SearchTweets\SearchTweetsOutput;
use App\Domain\ValueObject\UserId;

final class SearchTweetsInteractor implements SearchTweets
{
    private $input;
    private $tweetQueryService;

    public function __construct(
        SearchTweetsInput $input,
        TweetQueryService $tweetQueryService
    ) {
        $this->input = $input;
        $this->tweetQueryService = $tweetQueryService;
    }

    public function handler(): SearchTweetsOutput
    {
        $tweets = $this->searchTweet();
        return new SearchTweetsOutput($tweets);
    }

    private function searchTweet(): array
    {
        $userId = $this->userId();
        $tweetEntityes = $this->tweetQueryService->findAllByUserId($userId);
        return $tweetEntityes;
    }

    private function userId(): UserId
    {
        return new UserId($this->input->userId());
    }
}
