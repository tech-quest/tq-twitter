<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Adapter\QueryService\UserQueryService;
use App\UseCase\ShowProfileEdit\ShowProfileEditInteractor;
use App\Adapter\QueryService\ProfileQueryService;

$useCase = new ShowProfileEditInteractor(new ProfileQueryService());
$output = $useCase->handler();
$profileView = $output->profileView();
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
  <div class="profile-name">
    <p><?php echo $profileView->name(); ?></p>
  </div>
  <div class="profile-introduction">
    <p><?php echo $profileView->introduction(); ?></p>
  </div>
  <div class="profile-location">
    <p><?php echo $profileView->location(); ?></p>
  </div>
  <div class="profile-website">
    <p><?php echo $profileView->website(); ?></p>
  </div>
  <div class="profile-birthday">
    <p><?php echo $profileView->birthday(); ?></p>
  </div>
</body>