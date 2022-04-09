<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\UseCase\SearchTweets\SearchTweetsInput;
use App\UseCase\SearchTweets\SearchTweetsInteractor;
use App\Adapter\QueryService\TweetQueryService;
use App\Domain\ValueObject\TweetId;

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="text-center">
        <h1>profile</h1>
    </div>
    <?php foreach ($tweets as $tweet): ?>
        <div class="d-flex justify-content-center">
            <div class="p-2 bd-highlight mt-3">
                <?php echo $tweet->tweetBody()->value(); ?>
            </div>
            <div class="p-2 bd-highlight">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <form method="post" action="tweetDelete.php" class="dropdown-item">
                                    <input type="hidden" name="id" value="<?php echo $tweet
                                        ->tweetId()
                                        ->value(); ?>">
                                    <input type="submit" value="削除">
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php endforeach; ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </div>
</body>