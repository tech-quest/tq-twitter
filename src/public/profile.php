<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\UseCase\SearchTweets\SearchTweetsInput;
use App\UseCase\SearchTweets\SearchTweetsInteractor;
use App\Adapter\QueryService\TweetQueryService;

$session = Session::getInstance();
$authUser = $session->auth();

if (is_null($authUser)) {
    Redirect::handler('/signin.php');
}

$input = new SearchTweetsInput($authUser);
$tweetQueryService = new TweetQueryService();
$useCase = new SearchTweetsInteractor($input, $tweetQueryService);
$output = $useCase->handler();
$tweets = $output->tweets();

$session->clearErrors();
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
         <p><?php echo $tweet->tweetBody()->value(); ?></p>
    <?php endforeach; ?>
</body>