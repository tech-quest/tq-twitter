<?php

namespace App\UseCase\SearchTweetUseCase;

use App\Repository\TweetRepository;
use App\ValueObject\UserId;

final class SearchTweetInteractor
{
    private $input;
    private $tweetRepository;

    public function __construct(
        SearchTweetInput $input,
        TweetRepository $tweetRepository
    ) {
        $this->input = $input;
        $this->tweetRepository = $tweetRepository;
    }

    public function handler(): SearchTweetOutput
    {
        return $this->searchTweet();
    }

    private function searchTweet(): array
    {
        $userId = $this->userId();
        $tweetEntityes = $this->tweetRepository->findAllByUserId($userId);
        return $tweetEntityes;
    }

    private function userId(): UserId
    {
        return new UserId($this->input->userId());
    }
}
