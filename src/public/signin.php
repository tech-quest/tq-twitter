<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
    <h1>Twitterにログイン</h1>
    <form action="signin_search.php" method="post">
        <p><input type="text" name="email" placeholder="Email"></p>
        <p><input type="submit" value="次へ"></p>
    </form>

</body>

</html>