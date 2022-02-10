<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\Dao\TweetDao;

$session = Session::getInstance();
$authUser = $session->auth();

if (is_null($authUser)) {
    Redirect::handler('/signin.php');
}

$userId = $authUser->userId();

$session->clearErrors();

$tweetDao = new TweetDao();
$tweets = $tweetDao->findAllByUserId($userId);
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