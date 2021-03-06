<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Session;
use App\Domain\ValueObject\Email;
use App\UseCase\SignUp\ConfirmRegisterCertificationCode\Input;
use App\UseCase\SignUp\ConfirmRegisterCertificationCode\Interactor;

$session = Session::getInstance();
$name = $_SESSION['name'];
$email = $_SESSION['certificate_register_email'];

date_default_timezone_set('Asia/Tokyo');
$certificationCode = json_decode(file_get_contents('php://input'), true);
$userEmail = new Email($email);
$useCaseInput = new Input($certificationCode['code'], $userEmail);
$useCaseInteractor = new Interactor($useCaseInput);
$useCaseOutput = $useCaseInteractor->handler();

$response = [
    'data' => [
        'status' => $useCaseOutput->isSuccess(),
        'message' => $useCaseOutput->message(),
        'name' => $name,
        'email' => $email,
    ],
];
echo json_encode($response);
die();
