<?php

namespace App\Domain\Entity;

use DateTime;
use App\Domain\ValueObject\TweetId;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\TweetBody;
use App\Domain\ValueObject\ReplyTweetId;
use App\Domain\ValueObject\TweetDevice;
use App\Domain\ValueObject\TweetDate;
final class Tweet
{
    private $tweetId;
    private $userId;
    private $tweetBody;
    private $replyTweetId;
    private $device;
    private $createdAt;
    private $deletedAt;

    public function __construct(
        TweetId $tweetId,
        UserId $userId,
        TweetBody $tweetBody,
        ?ReplyTweetId $replyTweetId,
        TweetDevice $device,
        TweetDate $createdAt,
        ?DateTime $deletedAt
    ) {
        $this->tweetId = $tweetId;
        $this->userId = $userId;
        $this->tweetBody = $tweetBody;
        $this->replyTweetId = $replyTweetId;
        $this->device = $device;
        $this->createdAt = $createdAt;
        $this->deletedAt = $deletedAt;
    }

    public function tweetId(): TweetId
    {
        return $this->tweetId;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function tweetBody(): TweetBody
    {
        return $this->tweetBody;
    }

    public function replyTweetId(): ?ReplyTweetId
    {
        return $this->replyTweetId;
    }

    public function device(): TweetDevice
    {
        return $this->device;
    }

    public function createdAt(): TweetDate
    {
        return $this->createdAt;
    }

    public function deletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}
