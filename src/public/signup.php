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
          <input class="user-register__confirm password" type="text" name="name" />
        </div>
        <div class="user-password_box">
          <label for="confirm-register">パスワード確認</label>
          <input class="user-register__confirm confirm-password" type="text" name="name" />
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

<script>
  const userInputName = document.querySelector('.name');
  const userInputEmail = document.querySelector('.email');
  const userSearchSubmit = document.querySelector('.user-search')
  userInputName.addEventListener('click', (e) => {
    const name = e.target
    const nameLabel = name.previousElementSibling
    name.classList.add('focus')
    nameLabel.classList.add('move', 'focus')
  });

  userInputName.addEventListener('blur', (e) => {
    const name = e.target
    const nameLabel = name.previousElementSibling
    if (name.value === '') {
      nameLabel.classList.remove('move')
    }
    name.classList.remove('focus')
    nameLabel.classList.remove('focus')
  });

  userInputEmail.addEventListener('click', (e) => {
    const email = e.target
    const emailLabel = email.previousElementSibling
    email.classList.add('focus')
    emailLabel.classList.add('move', 'focus')
  });

  userInputEmail.addEventListener('blur', (e) => {
    const email = e.target
    const emailLabel = email.previousElementSibling
    if (email.value === '') {
      emailLabel.classList.remove('move')
    }
    email.classList.remove('focus')
    emailLabel.classList.remove('focus')
  });
</script>

<script>
  const userCreateInput = document.querySelector('.user-create__next');
  userCreateInput.addEventListener('click', async function(event) {
    event.preventDefault();
    const nameInput = document.querySelector('.name');
    const name = nameInput.value;
    const emailInput = document.querySelector('.email');
    const email = emailInput.value;

    if (name.length > 5) {
      const nameErrorMessage = document.querySelector('.name-error__output');
      nameErrorMessage.classList.add('name');
      return;
    }

    if (email.length === 0) {
      const emailErrorMessage = document.querySelector('.email-error__output');
      emailErrorMessage.classList.add('email');
      return;
    }

    const obj = {
      name,
      email
    }
    const body = JSON.stringify(obj);
    const headers = {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    };
    const response = await fetch(
      'Api/send-user-register-certification-code.php', {
        method: "POST",
        headers,
        body
      });
    const json = await response.json();
    if (!json.data['email']) {
      const userCreate = document.querySelector('.user-create');
      const userCertification = document.querySelector('.user-certification');
      userCreate.classList.add('remove');
      userCertification.classList.add('show');
    } else {
      const errorMessage = document.querySelector('.errorMessage');
      const output = document.querySelector('.output');
      output.classList.add('active');
      errorMessage.innerHTML = 'メールアドレスが登録されています。'
      setTimeout(() => {
        output.classList.remove('active');
      }, 2000)
    }
  }, false);

  const sendCertificateButton = document.querySelector('.send-certification__button');
  sendCertificateButton.addEventListener('click', async function(event) {
    event.preventDefault();
    const codeInput = document.querySelector('.send-certification');
    const code = codeInput.value;
    const obj = {
      code,
    };
    const body = JSON.stringify(obj);
    const headers = {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    };
    const response = await fetch(
      'Api/confirm-user-register-certification-code-input.php', {
        method: "POST",
        headers,
        body
      });
    const json = await response.json();
    if (json.data['certificationCode']) {
      const UserCertificationDisplay = document.querySelector('.user-certification__display');
      const userPassword = document.querySelector('.user-password');
      UserCertificationDisplay.classList.add('remove2');
      userPassword.classList.add('show2');
    } else {
      alert('認証コードを入力してください。');
    }

    const name = document.querySelector('.name-output');
    name.textContent = json.data['name'];
    const email = document.querySelector('.email-output');
    email.innerHTML = json.data['email'];
  }, false);
</script>

<script>
  const userRegisterButton = document.querySelector('.user-register__button');
  userRegisterButton.addEventListener('click', async function(event) {
    event.preventDefault();
    const passwordInput = document.querySelector('.password');
    const password = passwordInput.value;
    const confirmPasswordInput = document.querySelector('.confirm-password');
    const confirmPassword = confirmPasswordInput.value;

    if (password === '') {
      alert('パスワードを入力してください。');
      return;
    } else if (confirmPassword === '') {
      alert('パスワード確認を入力してください。');
      return;
    } else if (password !== confirmPassword) {
      alert('パスワードが一致していません。');
      return;
    }
    const obj = {
      password,
      confirmPassword
    };
    const body = JSON.stringify(obj);
    const headers = {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    };
    const response = await fetch(
      'Api/complete-user-register.php', {
        method: "POST",
        headers,
        body
      });

    const json = await response.json();
    if (json.data['result']) {
      const userPasswordDisplay = document.querySelector('.user-password__display');
      const completePassword = document.querySelector('.complete-password');
      userPasswordDisplay.classList.add('remove3');
      completePassword.classList.add('show3');
    }
  }, false);
</script>