<?php

ini_set('display_errors', 1);
require_once __DIR__ . '/../../vendor/autoload.php';

use App\UseCase\PasswordReset\SendResetPasswordCertification\Input;
use App\UseCase\PasswordReset\SendResetPasswordCertification\Interactor;
use Dotenv\Dotenv;
use App\Lib\Session;
use App\Domain\ValueObject\Email;

$session = Session::getInstance();
Dotenv::createImmutable(__DIR__ . '/../../')->load();
date_default_timezone_set('Asia/Tokyo');

$inputs = json_decode(file_get_contents('php://input'), true);
$email = new Email($inputs['email']);
$useCaseInput = new Input($email);
$useCaseInteractor = new Interactor($useCaseInput);
$useCaseInteractor->handler();
