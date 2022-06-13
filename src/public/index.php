<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Dao\TweetDao;
use App\Lib\Redirect;
use App\Lib\Session;
use App\Domain\ValueObject\Device;

$session = Session::getInstance();
$authUser = $session->auth();

if (is_null($authUser)) {
  Redirect::handler('/signin.php');
}

$tweetDao = new TweetDao();
$tweets = $tweetDao->findAllByTweets();
$device = $_SERVER['HTTP_USER_AGENT'];
$session->setUserId($authUser->userId());
$session->setDevice(new Device($device));
?>
<!DOCTYPE html>

<head>
  <title>Topページ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <div class="content">
      <?php require_once __DIR__ . '/left_nav.php'; ?>
      <main>
        <div class="container">
          <h1>Topページ</h1>
          <form method="post" action="tweetComplete.php">
            <input type="text" name="tweet" required placeholder="いまなにしてる?" />
            <input type="hidden" name="device" value="<?php echo $device; ?>" />
            <input type="submit" value="ツイートする" />
          </form>
          <?php foreach ($tweets as $tweet) : ?>
            <a href="status.php?id=<?php echo $tweet['id']; ?>">
              <p><?php echo $tweet['tweet']; ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      </main>
    </div>
    <div class="tweet-button tweet-modal">
      <div class="tweet-modal__form-wrapper tweet-form">
        <form action="" method="post">
          <div class="tweet-modal__input-wrapper input-area">
            <textarea id="inputForm" class="input-border tweet" placeholder="いまどうしてる？"></textarea>
          </div>
          <div class="tweet-modal__footer tweet-area">
            <div class="tweet-modal__left-section">
              <div class="tweet-modal__icon tweet-area_icon">
                <p>アイコン画像</p>
              </div>
            </div>
            <div class="tweet-modal__right-section">
              <div class="tweet-modal__count-wrapper">
                <span class="current-tweet-count">0</span>
                <span>/</span>
                <span>140</span>
              </div>
              <div class="tweet-modal__tweet-button-wrapper tweet-area_button">
                <input class="send-tweet" type="submit" value="ツイートする">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<script src="tweet-modal.js"></script>
<script src="account-info-modal.js"></script>