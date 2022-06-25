<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Session;

$session = Session::getInstance();
$authUser = $session->auth();
?>

<header class="left-bar">
  <h1 class="left-bar__logo">
    <a href="/top.php">
      <img class="left-bar__logo__image" src="/image/tech-quest-logo.jpg" alt="仮のDUMMYロゴです">
    </a>
  </h1>
  <nav class="menu nav flex-column">
    <a class="menu__item menu__item--active" aria-current="page" href="./top.php">
      <div class="menu__item__button">
        <i class="bi bi-house"></i>
        <span class="menu__item__button__label">ホーム</span>
      </div>
    </a>
    <a class="menu__item" href="#">
      <div class="menu__item__button">
        <i class="bi bi-hash"></i>
        <span class="menu__item__button__label">話題を検索</span>
      </div>
    </a>
    <a class="menu__item" href="#">
      <div class="menu__item__button">
        <i class="bi bi-bell"></i>
        <span class="menu__item__button__label">通知</span>
      </div>
    </a>
    <a class="menu__item" href="#">
      <div class="menu__item__button">
        <i class="bi bi-envelope"></i>
        <span class="menu__item__button__label">メッセージ</span>
      </div>
    </a>
    <a class="menu__item" href="#">
      <div class="menu__item__button">
        <i class="bi bi-bookmark"></i>
        <span class="menu__item__button__label">ブックマーク</span>
      </div>
    </a>
    <a class="menu__item" href="#">
      <div class="menu__item__button">
        <i class="bi bi-card-text"></i>
        <span class="menu__item__button__label">リスト</span>
      </div>
    </a>
    <a class="menu__item" href="./profile.php">
      <div class="menu__item__button">
        <i class="bi bi-card-text"></i>
        <span class="menu__item__button__label">プロフィール</span>
      </div>
    </a>
    <a class="menu__item" href="#">
      <div class="menu__item__button">
        <i class="bi bi-three-dots-vertical"></i>
        <span class="menu__item__button__label">もっと見る</span>
      </div>
    </a>
    <div class="menu__tweet">
      <button class="menu__tweet__btn btn btn-primary tweet-button" type="button">
        <span>
          ツイートする
        </span>
      </button>
    </div>
  </nav>
  <div class="account-info">
    <div class="account-info-wrapper">
      <div class="account-info__icon-image"><img height="40px" width="40px" src="./image/twittericon13.jpeg"></img></div>
      <div class="account-info__id-wrapper">
        <div><?php echo $authUser->userName()->value(); ?></div>
        <!-- TODO: アカウントIDテーブルを作成する -->
        <div>アカウントID</div>
      </div>
    </div>
    <div class="account-info-modal">
      <div class="account-info-wrapper">
        <div class="account-info__icon-image"><img height="40px" width="40px" src="./image/twittericon13.jpeg"></img></div>
        <div class="account-info__id-wrapper">
          <div><?php echo $authUser->userName()->value(); ?></div>
          <div>アカウントID2</div>
        </div>
      </div>

      <div class="account-info-modal__add-existing-account">既存のアカウントを追加</div>
      <div class="account-info-modal__logout"><a href="logout.php">ログアウト</a></div>
    </div>
  </div>
</header>