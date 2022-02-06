<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Dao\TweetDao;
use App\Lib\Redirect;
use App\Lib\Device;

$user_id = 1;
$tweet = filter_input(INPUT_POST, 'tweet');
$replyTweetId = 1;
$device = 'iphone';
$tweetsDao = new TweetDao();
$path = '/index.php';
Redirect::handler($path);
