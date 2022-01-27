<?php
require_once __DIR__ . '/Dao/TweetsDao.php';

$user_id = 1;
$tweet = filter_input(INPUT_POST, 'tweet');
$replyTweetId = 1;
$device = 'iphone';

$tweetsDao = new TweetsDao();
$tweetsDao->insert($user_id, $tweet, $replyTweetId, $device);
header('Location: /index.php');
