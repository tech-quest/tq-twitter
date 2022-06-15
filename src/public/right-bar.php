<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;

$session = Session::getInstance();
$authUser = $session->auth();

// if (is_null($authUser)) {
//   Redirect::handler('/signin.php');
// }
?>
<!DOCTYPE html>
<div class="sidebar">
    <div class="sidebar-search">
        <input type="text" placeholder="キーワード検索">
    </div>
    <div class=" sidebar-trend">
        <h2>いまどうしてる？</h2>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span>ニュース・ライブ</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span>テキストテキストテキストテキスト</span>
            </div>
            <div class="sidebar-trend__box-bottom">
                トレンドトピック:
                <a href="#">
                    <span>テキストテキストテキストテキスト</span>
                </a>
            </div>
        </div>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span>テクノロジー・トレンド</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span>テキストテキストテキストテキスト</span>
            </div>
            <div class="sidebar-trend__box-bottom">
                トレンドトピック:
                <a href="#">
                    <span>テキストテキストテキストテキスト</span>
                </a>
            </div>
        </div>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span>日本のトレンド</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span>テキストテキストテキストテキスト</span>
            </div>
            <div class="sidebar-trend__box-bottom">
                トレンドトピック:
                <a href="#">
                    <span>テキストテキストテキストテキスト</span>
                </a>
            </div>
        </div>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span>国際ニュース・ライブ</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span>テキストテキストテキストテキスト</span>
            </div>
            <div class="sidebar-trend__box-bottom">
                トレンドトピック:
                <a href="#">
                    <span>テキストテキストテキストテキスト</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-user">
        <div class="sidebar-user__wrapper">
            <div class="sidebar-user__icon">
                <img src="./image/twittericon13.jpeg"></img>
            </div>
            <div class="sidebar-user__name">
                <span>ユーザー1</span>
            </div>
            <div class="sidebar-user__id">
                <span>@ユーザー1</span>
            </div>
            <div class="sidebar-user__button">
                <span>フォロー</span>
            </div>
        </div>
    </div>
</div>

</html>