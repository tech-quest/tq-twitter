<?php
// require_once __DIR__ . '/Dao/TweetDao.php';

// $tweetDao = new TweetDao();
// $tweets = $tweetDao->findByAllTweets();
?>
<!DOCTYPE html>

<head>
  <title>レフトバー</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <main>
    <div class="container">
      <h1>レフトバーページ</h1>
      <link rel="stylesheet" href="style.css">
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
  </main>
</body>

</html>