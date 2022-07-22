<?php

namespace App\Domain\Adapter;

use App\Domain\Entity\Tweet;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\TweetId;

interface TweetQueryServiceInterface
{
  public function findById(TweetId $id): Tweet;
  public function findAllByUserId(UserId $userId): array;
}
