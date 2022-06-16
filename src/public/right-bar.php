<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;

$session = Session::getInstance();
$authUser = $session->auth();

if (is_null($authUser)) {
    Redirect::handler('/signin.php');
}
?>
<!DOCTYPE html>
<div class="sidebar">
    <div class="sidebar-search">
        <input type="text" placeholder="キーワード検索">
    </div>
    <div class="sidebar-trend">
        <span class="top-text">いまどうしてる？</span>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span class="title">ニュース・ライブ</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span class="trend">テキストテキストテキストテキスト</span>
            </div>
        </div>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span class="title">テクノロジー・トレンド</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span class="trend">テキストテキストテキストテキスト</span>
            </div>

        </div>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span class="title">日本のトレンド</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span class="trend">テキストテキストテキストテキスト</span>
            </div>

        </div>
        <div class="sidebar-trend__box">
            <div class="sidebar-trend__box-top">
                <span class="title">国際ニュース・ライブ</span>
            </div>
            <div class="sidebar-trend__box-middle">
                <span class="trend">テキストテキストテキストテキスト</span>
            </div>

        </div>
    </div>
    <div class="sidebar-user">
        <span class="top-text">おすすめユーザー</span>
        <div class="sidebar-user__wrapper">
            <div class="sidebar-user__icon">
                <img src="./image/twittericon13.jpeg"></img>
            </div>
            <div class="sidebar-user__wrapper-account">
                <div class="sidebar-user__name">
                    <span>ユーザー1</span>
                </div>
                <div class="sidebar-user__id">
                    <span>@ユーザー1</span>
                </div>
            </div>
            <div class="sidebar-user__button">
                <span>フォロー</span>
            </div>
        </div>
        <div class="sidebar-user__wrapper">
            <div class="sidebar-user__icon">
                <img src="./image/twittericon13.jpeg"></img>
            </div>
            <div class="sidebar-user__wrapper-account">
                <div class="sidebar-user__name">
                    <span>ユーザー2</span>
                </div>
                <div class="sidebar-user__id">
                    <span>@ユーザー2</span>
                </div>
            </div>
            <div class="sidebar-user__button">
                <span>フォロー</span>
            </div>
        </div>
        <div class="sidebar-user__wrapper">
            <div class="sidebar-user__icon">
                <img src="./image/twittericon13.jpeg"></img>
            </div>
            <div class="sidebar-user__wrapper-account">
                <div class="sidebar-user__name">
                    <span>ユーザー3</span>
                </div>
                <div class="sidebar-user__id">
                    <span>@ユーザー3</span>
                </div>
            </div>
            <div class="sidebar-user__button">
                <span>フォロー</span>
            </div>
        </div>
    </div>
</div>

</html>