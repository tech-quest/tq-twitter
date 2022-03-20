<?php
session_start();

$error = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
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
</body>

</html>