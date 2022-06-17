<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Session;
use App\Lib\Redirect;

$session = Session::getInstance();
$authUser = $session->auth();

if (is_null($authUser)) {
  Redirect::handler('/signin.php');
}

?>

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
    <input class="radius-pixel-20 btn btn-primary tweet-button" type="submit" value="ツイートする">
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
</div>