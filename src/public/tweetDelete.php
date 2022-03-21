<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Dao\TweetDao;
use App\Lib\Redirect;

$tweetId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$tweetDao = new TweetDao();
$tweetDao->delete($tweetId);
$path = '/index.php';
Redirect::handler($path);
