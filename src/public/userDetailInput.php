<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Session;

$session = Session::getInstance();
$errors = $session->errors();
$session->clearErrors();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>userDetailInput</title>
</head>

<body>
  <div>
    <div class="user-detail">
      <p><?php echo $errors[0]; ?></p>
      <div class="user-detail__input">
        <h1>Twitterアカウントを探す</h1>
        <form action="" method="post">
          <div class="field">
            <label for="email">メールアドレスか電話番号かユーザー名を入力してください</label>
            <input class="user-info input" type="text" name="name" />
          </div>
          <input class="user-search" type="submit" value="検索" disabled />
        </form>
      </div>
    </div>
    <div class="message output">
      <p class="errorMessage"></p>
    </div>
  </div>

  <div class="user-detail__result user-detail__display">
    <div class="user-detail__input">
      <h2>どのようにパスワードをリセットしますか？</h2>
      <form action="" method="post">
        <p class="result"></p>
        <div class="send-box">
          <p class="text">
            認証コードを
            <span class="email user-email"></span>
            にメールで送信する
          </p>
        </div>
        <a class="button" href="/signin.php">キャンセル</a>
        <input class="send-user" type="submit" value="次へ">
      </form>
    </div>
  </div>
  <div class="user-certification user-certification__display">
    <div class="user-certification__input">
      <h3>メールアドレスを確認する</h3>
      <p>アカウントパスワードをリセットするための認証コードがこちらに送信されます。</p>
      <form action="" method="post">
        <p class="result"></p>
        <div class="send-box">
          <input class="send-certification" type="text" name="name" />
        </div>
        <a class="button-certification" href="/signin.php">コードが届かない場合</a>
        <input class="send-certification__button" type="submit" value="認証する">
      </form>
    </div>
  </div>

  <div class="user-password user-password__display">
    <div class="user-password__input">
      <h4>新しいパスワードを入力してください</h4>
      <form action="" method="post">
        <div class="user-password_box">
          <input class="user-password__send" type="text" name="name" />
        </div>
        <a class="button-password" href="/signin.php">キャンセル</a>
        <input class="user-password__button" type="submit" value="変更する">
      </form>
    </div>
  </div>

  <div class="complete-password">
    <div class="">
      <h5>パスワードの変更が完了しました</h5>
      <a class="button-complete" href="/signin.php">ログイン</a>
    </div>
  </div>
</body>

</html>
<script>
  const userInfoInput = document.querySelector('.user-info.input');
  const userSearchSubmit = document.querySelector('.user-search')
  userInfoInput.addEventListener('change', (e) => {
    userSearchSubmit.disabled = e.target.value === '';
  });

  userInfoInput.addEventListener('click', (e) => {
    const target = e.target
    const label = target.previousElementSibling
    target.classList.add('focus')
    label.classList.add('move', 'focus')
  })

  userInfoInput.addEventListener('blur', (e) => {
    const target = e.target
    const label = target.previousElementSibling
    if (target.value === '') {
      label.classList.remove('move')
    }
    target.classList.remove('focus')
    label.classList.remove('focus')
  })
</script>
<script>
  const btn = document.querySelector('.user-search');
  const userDetailResult = document.querySelector('.user-detail__result');
  const userDetail = document.querySelector('.user-detail');

  btn.addEventListener('click', async function(event) {
    event.preventDefault();
    const searchInput = document.querySelector('.input');
    const input = searchInput.value;
    if (!input) {
      const errorMessage = document.querySelector('.errorMessage');
      return;
    }
    const obj = {
      input,
    };
    const body = JSON.stringify(obj);
    const headers = {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    };
    const response = await fetch(
      'Api/searchUserDetailInput.php', {
        method: "POST",
        headers,
        body
      });

    const json = await response.json();
    if (json.data['email']) {
      userDetailResult.classList.add('active');
      userDetail.classList.add('active');
      const email = document.querySelector('.email');
      const result = document.querySelector('.result');
      result.innerHTML = 'このアカウントに関する以下の情報が見つかりました。'
      email.innerHTML = json.data['email'];
    } else {
      const errorMessage = document.querySelector('.errorMessage');
      const output = document.querySelector('.output');
      output.classList.add('active');
      errorMessage.innerHTML = 'アカウントが見つかりません。'

      setTimeout(() => {
        output.classList.remove('active');
      }, 2000)
    }
  }, false);
