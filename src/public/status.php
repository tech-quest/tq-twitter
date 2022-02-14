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
<!DOCTYPE html>
<head>
  <title>ツイート詳細ページ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body id="status">
  <main>
    <div class="container">
      <h1>ツイート詳細ページ</h1> 
      <div class="tweet-status">
        <p class="tweet-status_tweet"><?php echo $tweet['tweet']; ?></p>
        <p class="tweet-status_date"><?php echo $tweetDate->date() .
            '・' .
            'Twitter for' .
            ' ' .
            $tweet['device']; ?></p>
      </div>
      <div class="tweet-button">
        <a href="">Reply</a>
        <a href="">Retweet</a>
        <a href="">Like</a>
        <a href="">Share</a>
      </div>
    </div>
  </main>
</body>
</html>
