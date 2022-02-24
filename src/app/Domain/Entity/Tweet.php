<?php

final class Tweet
{
    private $tweetId;
    private $userId;
    private $tweet;
    private $replyTweetId;
    private $device;
    // private $createdAt;

    public function __construct(
        TweetId $tweetId,
        UserId $userId,
        Tweet $tweet,
        ReplyTweetId $replyTweetId,
        Device $device
    ) {
        // CreatedAt $createdAt
        $this->tweetId = $tweetId;
        $this->userId = $userId;
        $this->tweet = $tweet;
        $this->replyTweetId = $replyTweetId;
        $this->device = $device;
        // $this->createdAt = $createdAt;
    }

    public function tweetId(): TweetId
    {
        return $this->tweetId;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function tweet(): Tweet
    {
        return $this->tweet;
    }

    public function replyTweetId(): ReplyTweetId
    {
        return $this->replyTweetId;
    }

    public function device(): Device
    {
        return $this->device;
    }

    // public function createdAt(): CreatedAt
    // {
    //     return $this->createdAt;
    // }
}
