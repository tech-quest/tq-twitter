<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Dao\TweetDao;
use App\Lib\TweetDate;

$id = explode(',', $_SERVER['QUERY_STRING']);
$tweetId = $id[0];
$user_Id = $id[1];

$tweetDao = new TweetDao();
$tweet = $tweetDao->findById($tweetId, $user_Id);
$tweetDate = new TweetDate($tweet['created_at']);
?>
<h1>ツイート詳細ページ</h1> 
<p><?php echo $tweet['tweet']; ?></p>
<p><?php echo $tweetDate->date() .
    '・' .
    'Twitter for' .
    ' ' .
    $tweet['device']; ?></p>
