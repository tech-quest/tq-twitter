<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Dao\TweetDao;

$user_id = 1;
$tweet = filter_input(INPUT_POST, 'tweet');
$replyTweetId = 1;
$device = 'iphone';
$tweetsDao = new TweetDao();
$path = '/index.php';
Redirect::handler($path);
