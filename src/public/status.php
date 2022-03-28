<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\UseCase\GetTweetDetail\GetTweetDetailInteractor;
use App\UseCase\GetTweetDetail\GetTweetDetailInput;
use App\Domain\ValueObject\TweetId;

$tweetId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$input = new GetTweetDetailInput(new TweetId($tweetId));
$useCase = new GetTweetDetailInteractor($input);
$output = $useCase->handler();
$tweet = $output->tweet();
?>
<!DOCTYPE html>

<head>
  <title>ツイート詳細ページ</title>
  <link rel="stylesheet" href="style.css">
</head>

<body id="status">
  <main>
    <div class="container">
      <button type=“button” onclick="location.href='../index.php'">←</button>
      <h1>ツイート詳細ページ</h1>
      <div class="tweet-status">
        <p class="tweet-status__tweet"><?php echo $tweet
            ->tweetBody()
            ->value(); ?></p>
        <p class="tweet-status__date"><?php echo $tweet->createdAt()->date() .
            '・' .
            'Twitter for' .
            ' ' .
            $tweet->device()->value(); ?></p>
      </div>
      <div class="tweet-button">
        <a href="">Reply</a>
        <a href="">Retweet</a>
        <a href="">Like</a>
        <a href="" class="modalopen">Share</a>
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
  const buttonOpen = document.querySelector('.modalopen');
  const modal = document.querySelector('.modal');
  buttonOpen.addEventListener('click', function(e) {
    e.preventDefault();
    modal.classList.add('active');
    overlay.classList.add('active');
  });
</script>