<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Dao\TweetDao;

$tweetDao = new TweetDao();
$tweets = $tweetDao->findAllByTweets();
$device = $_SERVER['HTTP_USER_AGENT'];
?>
<!DOCTYPE html>

<head>
    <title>Topページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
</body>

</html>