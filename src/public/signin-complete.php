<?php

use App\Adapter\QueryService\UserQueryService;

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
        throw new Exception('不正な値が入力されました。');
    }

    $userEmail = new Email($email);
    $inputPassword = new Password($password);
    $useCaseInput = new SignInInput($userEmail, $inputPassword);
    $useCase = new SignInInteractor($useCaseInput, new UserQueryService());
    $useCaseOutput = $useCase->handler();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();

    Redirect::handler('/index.php');
} catch (Exception $e) {
    // TODO: バリデーションの例外とユースケースの例外を別々で処理するようにする
    $session->setErrors($errors);
    $session->setInputEmail($email);

    Redirect::handler('/signin.php');
}
