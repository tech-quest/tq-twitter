<?php

namespace App\UseCase\GetTweetDetail;

use App\Adapter\QueryService\TweetQueryService;
use App\UseCase\GetTweetDetail\GetTweetDetailInput;
use App\UseCase\GetTweetDetail\GetTweetDetailOutput;

final class GetTweetDetailInteractor implements GetTweetDetail
{
    /**
     * @var TweetQueryService
     */
    private $tweetQueryService;

    /**
     * @var GetTweetDetailInput
     */
    private $input;

    public function __construct(GetTweetDetailInput $input)
    {
        $this->tweetQueryService = new TweetQueryService();
        $this->input = $input;
    }

    public function handler(): GetTweetDetailOutput
    {
        $tweetId = $this->input->tweetId();
        $tweet = $this->tweetQueryService->findById($tweetId);
        return new GetTweetDetailOutput($tweet);
    }
}
