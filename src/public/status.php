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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body id="status">
  <main>
    <div class="container">
      <div class="d-flex flex-row-reverse bd-highlight">
        <div class="p-2 bd-highlight">
            <nav class="navbar navbar-expand-lg">        
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                          </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <form method="post" action="tweetDelete.php" class="dropdown-item">
                            <input type="hidden" name="id" value="<?php echo $tweetId; ?>">
                            <input type="submit" value="削除">
                          </form>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="p-2 bd-highlight">
          <h1>ツイート詳細ページ</h1>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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