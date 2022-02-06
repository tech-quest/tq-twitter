<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Dao\TweetDao;
use App\Lib\Redirect;
use App\Lib\Device;

$user_id = 1;
$tweet = filter_input(INPUT_POST, 'tweet');
$replyTweetId = 1;
$deviceName = filter_input(INPUT_POST, 'device');

$device = new Device($deviceName);
$tweetsDao = new TweetDao();
$tweetsDao->insert($user_id, $tweet, $replyTweetId, $device->tweetDevice());

$path = '/index.php';
Redirect::handler($path);
