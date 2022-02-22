<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Dao\TweetDao;
use App\Lib\TweetDate;

$tweetId = $_SERVER['QUERY_STRING'];
$tweetDao = new TweetDao();
$tweet = $tweetDao->findById($tweetId);
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
        <a href="" class="modalOpen">Share</a>
      </div>
      <div class="modal">
        <a href="">ダイレクトメッセージで送信</a>
        <a href="">ブックマーク</a>
        <a href="">リンク</a> 
      </div>
    </div>
  </main>
</body>
</html>

<script>
  const buttonOpen = document.querySelector('.modalOpen');
  const modal = document.querySelector('.modal');
  buttonOpen.addEventListener('click', function(e) {
    e.preventDefault();
    modal.classList.add('active');
    overlay.classList.add('active');
  });
</script>