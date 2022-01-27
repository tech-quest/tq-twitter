<?php
require_once __DIR__ . '/Dao/TweetsDao.php';

$tweetsDao = new TweetsDao();
$tweets = $tweetsDao->findByAllTweets();
?>
<!DOCTYPE html>

<head>
    <title>Topページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="container">
            <h1>Topページ</h1>
            <form method="post" action="tweetComplete.php">
                <input type="text" name="tweet" required placeholder="いまなにしてる?" />
                <input type="submit" value="ツイートする" />
            </form>
            <?php foreach ($tweets as $tweet) : ?>
                <p><?php echo $tweet['tweet']; ?></p>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>