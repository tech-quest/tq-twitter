<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Dao\UserDao;

$newPassword = filter_input(INPUT_POST, 'password');
$id = filter_input(INPUT_POST, 'id');
$passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

$user = new UserDao();
$newPassword = $user->updatePassword($id, $passwordHash);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newPassword</title>
</head>

<body>
    <p>パスワードが変更されました</p>
    <a href="signin.php">ログイン画面へ戻る</a>
</body>

</html>