<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\Infrastructure\Validator\SignInInputValidator;
use App\Infrastructure\Dao\UserDao;
use App\Domain\ValueObject\AuthUser;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;

$session = Session::getInstance();

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

try {
    $signInInputError = new SignInInputValidator($email, $password);
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

    Redirect::handler('/index.php');
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
