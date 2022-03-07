<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Dao\TweetDao;
use App\Lib\Redirect;
use App\Domain\ValueObject\Device;

$user_id = 2;
$tweet = filter_input(INPUT_POST, 'tweet');
$replyTweetId = 4;
$deviceInfo = filter_input(INPUT_POST, 'device');

$device = new Device($deviceInfo);
$tweetsDao = new TweetDao();
$tweetsDao->insert($user_id, $tweet, $replyTweetId, $device->tweetDevice());

$path = '/index.php';
Redirect::handler($path);
