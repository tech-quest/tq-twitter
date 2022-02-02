<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Dao\UserDao;
// require_once __DIR__ . '/Lib/Redilect.php';
// require_once __DIR__ . '/Dao/UserDao.php';

session_start();

$email = filter_input(INPUT_POST, 'email');

try {
    $errors = [];

    if (empty($email)) {
        $errors['email'] = 'Emailが空です';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        Redirect::handler('/signin.php');
    }

    $userDao = new UserDao();
    $user = $userDao->findByEmail($email);

    if (is_null($user)) {
        $errors['error'] = 'Emailまたはパスワードが違います';
        $_SESSION['errors'] = $errors;
        Redirect::handler('/signin.php');
    }

    $_SESSION['auth'] = [
        'userId' => $user['id'],
        'userName' => $user['name'],
        'email' => $user['email'],
    ];

    Redirect::handler('/index.php');
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
