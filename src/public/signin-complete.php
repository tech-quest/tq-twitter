<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\Validator\SignInInputValidator;
use App\Dao\UserDao;
use App\ValueObject\AuthUser;
use App\ValueObject\UserId;
use App\ValueObject\Email;

$session = Session::getInstance();

$email = filter_input(INPUT_POST, 'email');

try {
    $signInInputError = new SignInInputValidator($email);
    $errors = $signInInputError->allErrors();

    if (!empty($errors)) {
        $session->setErrors($errors);
        Redirect::handler('/signin.php');
    }

    $userDao = new UserDao();
    $user = $userDao->findByEmail($email);

    if (is_null($user)) {
        $errors = ['Emailまたはパスワードが違います'];
        $session->setErrors($errors);
        Redirect::handler('/signin.php');
    }

    $authUser = new AuthUser(
        new UserId($user['id']),
        $user['name'],
        new Email($user['email'])
    );

    $session->setAuth($authUser);

    Redirect::handler('/profile.php');
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
