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
    <div class="left-bar">
      <nav class="nav flex-column">
        <a class="nav-link active" aria-current="page" href="#">
          <img src="" alt="" width="30" height="30" class="">
          ホーム
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          話題を検索
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          通知
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          メッセージ
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          ブックマーク
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          リスト
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          プロフィール
        </a>
        <a class="nav-link" href="#">
          <img src="" alt="" width="30" height="30" class="">
          もっと見る
        </a>
        <a href="/"><input class="radius-pixel-20 btn btn-primary" type="submit" value="ツイートする"></a>
      </nav>
    </div>
    <main>
      <div class="container">
        <h1>Topページ</h1>
        <form method="post" action="tweetComplete.php">
          <input type="text" name="tweet" required placeholder="いまなにしてる?" />
          <input type="hidden" name="device" value="<?php echo $device; ?>" />
          <input type="submit" value="ツイートする" />
        </form>
        <?php foreach ($tweets as $tweet): ?>
          <a href="status.php?id=<?php echo $tweet['id']; ?>">
            <p><?php echo $tweet['tweet']; ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </main>
  </div>
    <div class="tweet-button tweet-modal">
      <div class="tweet-form">
        <div class="tweet-content">
          <form action="" method="post">
            <div class="input-area">
              <textarea id="inputForm" class="input-border tweet" placeholder="いまどうしてる？"></textarea>
            </div>
            <div class="tweet-area">
              <div class="tweet-area_icon">
                <p>アイコン画像</p>
              </div>
              <div class="tweet-area_button">
                <input class="send-tweet" type="submit" value="ツイートする">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script>
  const tweetButton = document.querySelector('.tweet-button');
  tweetButton.addEventListener('click', async function(event) {
    event.preventDefault();
    const tweetModal = document.querySelector('.tweet-modal');
    tweetModal.classList.add('show-modal');
  }, false);
</script>

<script>
  const sendTweet = document.querySelector('.send-tweet');
  sendTweet.addEventListener('click', async function(event) {
    event.preventDefault();
    const tweetInput = document.querySelector('.tweet');
    const tweet = tweetInput.value;
    const obj = {
      tweet,
    };
    const body = JSON.stringify(obj);
    const headers = {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    };
    const response = await fetch(
      'Api/complete-user-tweet.php', {
        method: "POST",
        headers,
        body
      });
    const json = await response.json();
    if (json.data.status) {
      const tweetModal = document.querySelector('.tweet-modal');
      tweetModal.classList.remove('show-modal');
      window.location.reload();
    }
  }, false);
</script>

<script>
  const inputValue = document.getElementById("inputForm")
  inputValue.addEventListener('keyup', (event) => {
    const input = inputValue.value;
    console.log(input);
    if (input.length >= 10) {
      inputValue.classList.add('color');
      const sendTweet = document.querySelector('.send-tweet');
      sendTweet.classList.add('hover');
      sendTweet.disabled = true;
    }
    if (input.length <= 10) {
      inputValue.classList.remove('color');
      const sendTweet = document.querySelector('.send-tweet');
      sendTweet.classList.remove('hover');
      sendTweet.disabled = false;
    }
  }, false);
</script>

<script>
  const tweetModal = document.querySelector('.tweet-modal');
  tweetModal.addEventListener('click', (event) => {
    if (!tweetModal.classList.contains('show-modal')) {
      return;
    }
    if (event.target === event.target.closest('.tweet-modal')) {
      tweetModal.classList.remove('show-modal');
    }
  }, false);
</script>