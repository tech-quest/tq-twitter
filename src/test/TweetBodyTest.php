<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\ValueObject\TweetBody;
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Exception\OutOfRangeException;

final class TweetBodyTest extends TestCase
{
    /** @test */
    public function ツイートが1文字の時_エラーが発生しないこと()
    {
        $expected = 'a';
        $tweetBody = new TweetBody($expected);
        $actual = $tweetBody->value();
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function ツイートが140文字の時_エラーが発生しないこと()
    {
        $expected = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $tweetBody = new TweetBody($expected);
        $actual = $tweetBody->value();
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function ツイートが0文字の時_エラーが発生すること()
    {
        $this->expectException(OutOfRangeException::class);
        new TweetBody('');
    }

    /** @test */
    public function ツイートが141字の時_エラーが発生すること()
    {
        $this->expectException(OutOfRangeException::class);
        new TweetBody(
            'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        );
    }
}
