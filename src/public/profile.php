<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Dao\TweetDao;
use App\ValueObject\UserId;

$loginUser = $_SESSION['auth'] ?? null;
$userId = $loginUser['userId'] ?? null;

unset($_SESSION['errors']);

$userIdObject = new UserId($userId);
$tweetDao = new TweetDao();
$tweets = $tweetDao->findAllByUserId($userIdObject);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
  <h1>profile</h1>
   <?php foreach ($tweets as $tweet): ?>
         <p><?php echo $tweet['tweet']; ?></p>
    <?php endforeach; ?>
</body>