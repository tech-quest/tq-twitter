<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\UseCase\GetTweetDetail\GetTweetDetailInput;
use App\UseCase\GetTweetDetail\GetTweetDetailInteractor;
use App\Domain\Adapter\TweetQueryServiceInterface;
use App\Domain\ValueObject\TweetId;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\TweetBody;
use App\Domain\ValueObject\TweetDevice;
use App\Domain\ValueObject\TweetDate;
use App\Domain\Entity\Tweet;
use PHPUnit\Framework\TestCase;

final class GetTweetDetailTest extends TestCase
{
  /** @test */
  public function tweetIdが存在する場合tweetEntityが取得されていること()
  {
    $usecaseInput = new GetTweetDetailInput(
      new TweetId(1)
    );
    $usecaseInteractor = new GetTweetDetailInteractor(
      $usecaseInput,
      new class implements TweetQueryServiceInterface
      {
        public function findById(TweetId $id): Tweet
        {
          return new Tweet(
            new TweetId(1),
            new UserId(1),
            new TweetBody('test'),
            null,
            new TweetDevice('test'),
            new TweetDate('2022-07-22 20:37:04'),
            null,
          );
        }

        public function findAllByUserId(UserId $userId): array
        {
          return [];
        }
      }
    );
    $usecaseOutput = $usecaseInteractor->handler();
    $this->assertTrue($usecaseOutput->tweet() instanceof Tweet);
  }
}
