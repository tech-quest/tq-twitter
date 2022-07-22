<?php

namespace App\UseCase\GetTweetDetail;

use App\UseCase\GetTweetDetail\GetTweetDetailInput;
use App\UseCase\GetTweetDetail\GetTweetDetailOutput;
use App\Domain\Adapter\TweetQueryServiceInterface;

final class GetTweetDetailInteractor implements GetTweetDetail
{
    /**
     * @var TweetQueryServiceInterface
     */
    private $tweetQueryService;

    /**
     * @var GetTweetDetailInput
     */
    private $input;

    public function __construct(GetTweetDetailInput $input, TweetQueryServiceInterface $tweetQuery)
    {
        $this->tweetQueryService = $tweetQuery;
        $this->input = $input;
    }

    public function handler(): GetTweetDetailOutput
    {
        $tweetId = $this->input->tweetId();
        $tweet = $this->tweetQueryService->findById($tweetId);
        return new GetTweetDetailOutput($tweet);
    }
}
