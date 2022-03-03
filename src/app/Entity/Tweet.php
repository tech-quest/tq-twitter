<?php

namespace App\Entity;

use DateTime;
use App\ValueObject\TweetId;
use App\ValueObject\UserId;
use App\ValueObject\ReplyTweetId;

final class Tweet
{
    private $id;
    private $userId;
    private $tweet;
    private $replyTweetId;
    private $device;
    private $deletedAt;

    public function __construct(
        TweetId $id,
        UserId $userId,
        string $tweet,
        ?ReplyTweetId $replyTweetId,
        ?string $device,
        ?DateTime $deletedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->tweet = $tweet;
        $this->replyTweetId = $replyTweetId;
        $this->device = $device;
        $this->deletedAt = $deletedAt;
    }

    public function id(): TweetId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function tweet(): string
    {
        return $this->tweet;
    }

    public function replyTweetId(): ?ReplyTweetId
    {
        return $this->replyTweetId;
    }

    public function device(): ?string
    {
        return $this->device;
    }

    public function deletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}
