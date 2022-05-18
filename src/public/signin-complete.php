<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;
use App\Infrastructure\Validator\SignInInputValidator;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\UseCase\Signin\SignInInput;
use App\UseCase\Signin\SignInInteractor;

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

    $userEmail = new Email($email);
    $inputPassword = new Password($password);
    $useCaseInput = new SignInInput($userEmail, $inputPassword);
    $useCase = new SignInInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();

    Redirect::handler('/editProfile.php');
} catch (Exception $e) {
    $errors = [$e->getMessage()];
    $session->setErrors($errors);
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] = $email;
    Redirect::handler('/signin.php');
    die();
}
