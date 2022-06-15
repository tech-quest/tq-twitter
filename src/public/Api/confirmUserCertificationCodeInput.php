<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Session;
use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\Domain\ValueObject\Email;
use App\UseCase\PasswordReset\ConfirmUserCertification\Interactor;

$session = Session::getInstance();
$email = $session->certificateEmail();
date_default_timezone_set('Asia/Tokyo');

$inputs = json_decode(file_get_contents('php://input'), true);
$certificationCode = $inputs['code'];
$useCaseInput = new Input(new Email($email->value()), $certificationCode);
$useCaseInteractor = new Interactor($useCaseInput);
$useCaseOutput = $useCaseInteractor->handler();
$response = [
    'data' => [
        'status' => $useCaseOutput->isSuccess(),
        'message' => $useCaseOutput->message(),
    ],
];
echo json_encode($response);
die();
