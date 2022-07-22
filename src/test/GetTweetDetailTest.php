<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\UseCase\GetTweetDetail\GetTweetDetailInput;
use App\Domain\ValueObject\TweetId;
use PHPUnit\Framework\TestCase;

final class SigninTest extends TestCase
{
  /** @test */
  public function tweetIdが存在する場合tweetが取得されていること()
  {
    $usecaseInput = new GetTweetDetailInput(
      new TweetId('test')
    );
  }
}
