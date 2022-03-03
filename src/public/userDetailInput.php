<?php
session_start();

$error = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userDetailInput</title>
</head>

<body>
    <p><?php echo $error[0]; ?></p>
    <h1>パスワードの変更確認</h1>
    <form action="passwordReset.php" method="post">
        <p><input type="text" name="name" placeholder="名前"></p>
        <p><input type="text" name="email" placeholder="Email"></p>
        <p><input type="submit" value="次へ"></p>
    </form>
</body>

</html>