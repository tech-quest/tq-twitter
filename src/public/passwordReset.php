<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Validator\UserDetailInputValidator;
use App\Lib\Session;
use App\Lib\Redirect;
use App\Infrastructure\Dao\UserDao;

$sesstion = Session::getInstance();

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');

$userConfirmValidator = new UserDetailInputValidator($name, $email);
$errors = $userConfirmValidator->allErrors();
if (!empty($errors)) {
    $sesstion->setErrors($errors);
    Redirect::handler('/userDetailInput.php');
}

$userDao = new UserDao();
$user = $userDao->findByEmail($email);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>passwordReset</title>
</head>

<body>
    <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
    <h1>新しいパスワードを入力してください</h1>
    <form action="newPassword.php" method="post">
        <p><input type="password" name="password" placeholder="password"></p>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <p><input type="submit" value="変更する"></p>
    </form>

</body>

</html>