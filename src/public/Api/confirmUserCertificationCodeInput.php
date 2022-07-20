<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Session;
use App\Adapter\PasswordResetCertification\Query\PasswordResetCertificationQueryService;
use App\Adapter\PasswordResetCertification\Repository\PasswordResetCertificationRepository;
use App\UseCase\PasswordReset\ConfirmUserCertification\Input;
use App\UseCase\PasswordReset\ConfirmUserCertification\Interactor;
use App\Domain\ValueObject\CertificationCode;

$session = Session::getInstance();
$email = $session->certificateEmail();
date_default_timezone_set('Asia/Tokyo');

$inputs = json_decode(file_get_contents('php://input'), true);
$certificationCode = new CertificationCode($inputs['code'], $email);
$useCaseInput = new Input($email, $certificationCode);
$useCaseInteractor = new Interactor(
    $useCaseInput,
    new PasswordResetCertificationQueryService(),
    new PasswordResetCertificationRepository()
);
$useCaseOutput = $useCaseInteractor->handler();
$response = [
    'data' => [
        'status' => $useCaseOutput->isSuccess(),
        'message' => $useCaseOutput->message(),
    ],
];
echo json_encode($response);
die();
