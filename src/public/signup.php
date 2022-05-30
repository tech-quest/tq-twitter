<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Session;

$session = Session::getInstance();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div>
        <div class="user-create">
            <div class="user-create__input">
                <h1>アカウントを作成</h1>
                <form action="" method="post">
                    <div class="field">
                        <div class="user-create__name">
                            <label for="name">名前</label>
                            <input class="name" type="text" name="name" />
                            <span class="name-error__message name-error__output">名前は1文字以上、5文字以下で入力してください</span>
                        </div>
                        <div>
                            <label for="email">メールアドレス</label>
                            <input class="email" type="text" name="email" />
                            <span class="email-error__message email-error__output">メールアドレスを入力してください</span>
                        </div>
                    </div>
                    <input class="user-create__next" type="submit" value="次へ" />
                </form>
            </div>
        </div>
        <div class="message output">
            <p class="errorMessage"></p>
        </div>
    </div>

    <div class="user-certification user-certification__display">
        <div class="user-certification__input">
            <h2>メールアドレスを確認する</h2>
            <p class="user-certification__register">アカウントを作成するための認証コードがこちらに送信されます。</p>
            <form action="" method="post">
                <p class="result"></p>
                <div class="send-box">
                    <input class="send-certification" type="text" name="name" />
                </div>
                <a class="button-certification" href="/signup.php">コードが届かない場合</a>
                <input class="send-certification__button" type="submit" value="認証する">
            </form>
        </div>
    </div>

    <div class="user-password user-password__display">
        <div class="user-password__input">
            <h4>パスワードを入力してください</h4>
            <form action="" method="post">
                <div class="user-name">
                    <label for="confirm-register">名前</label>
                    <p class="name-output"></p>
                </div>
                <div class="user-email">
                    <label for="confirm-register">メールアドレス</label>
                    <p class="email-output"></p>
                </div>
                <div class="user-password_box">
                    <label for="confirm-register">パスワード</label>
                    <input class="user-register__confirm password" type="password" name="name" />
                </div>
                <div class="user-password_box">
                    <label for="confirm-register">パスワード確認</label>
                    <input class="user-register__confirm confirm-password" type="password" name="name" />
                </div>
                <a class="button-password" href="/signin.php">キャンセル</a>
                <input class="user-register__button" type="submit" value="登録する">
            </form>
        </div>
    </div>
    <div class="complete-password">
        <div class="">
            <h5>アカウントが作成できました。</h5>
            <a class="button-complete" href="/signin.php">ログイン</a>
        </div>
    </div>

</body>

</html>
<script src="search-user.js"></script>
<script src="create-user.js"></script>
<script src="signup.js"></script>