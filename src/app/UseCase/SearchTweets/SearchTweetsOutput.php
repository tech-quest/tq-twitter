<?php

namespace App\UseCase\SearchTweets;

use App\Domain\Entity\Tweet;

final class SearchTweetsOutput
{
    private $tweets;

    public function __construct(array $tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * Tweetエンティティの配列を返す
     *
     * @return Tweet[]
     */
    public function tweets(): array
    {
        return $this->tweets;
    }
}
