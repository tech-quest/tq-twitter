<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Birthday;

class BirthdayTest extends TestCase
{
    /** @test */
    public function 誕生日が現在日時より過去の時_エラーが発生しないこと()
    {
        $date = new DateTime('2011-1-1');
        $birthday = new Birthday($date);
        $actual = $birthday->value()->format('Y-m-d');
        $expected = $date->format('Y-m-d');

        $this->assertSame($expected, $actual);
    }

    /** 
     * @test 
     */
    public function 誕生日が現在日時より未来の時_エラーが発生すること()
    {
        $this->expectException(Exception::class);
        $date = new DateTime('2031-1-1');
        $birthday = new Birthday($date);
    }
}
