<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\Dao\UserDao;
use App\ValueObject\AuthUser;
use App\ValueObject\UserId;
use App\ValueObject\Email;

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

    $authUser = new AuthUser(
        new UserId($user['id']),
        $user['name'],
        new Email($user['email'])
    );

    $session = Session::getInstance();
    $session->setAuth($authUser);

    Redirect::handler('/profile.php');
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
