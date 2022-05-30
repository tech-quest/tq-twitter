<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Session;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\UseCase\SignUp\CompleteUserRegister\Input;
use App\UseCase\SignUp\CompleteUserRegister\Interactor;

$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');

$password = json_decode(file_get_contents('php://input'), true);
$hashCertificateRegisterCode = $_SESSION['hash_certificate_register'];
$name = new Name($_SESSION['name']);
$email = new Email($_SESSION['certificate_register_email']);

$useCaseInput = new Input($password['password'], $hashCertificateRegisterCode, $name, $email);
$useCaseInteractor = new Interactor($useCaseInput);
$useCaseOutput = $useCaseInteractor->handler();

if ($useCaseOutput === true) {
    $_SESSION = [];
    session_destroy();
}

$response = [
    'data' => [
        'status' => $useCaseOutput->isSuccess(),
        'message' => $useCaseOutput->message(),
    ],
];
echo json_encode($response);
die();
