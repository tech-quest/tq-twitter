<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Session;
use App\Adapter\PasswordResetCertification\Repository\PasswordResetCertificationRepository;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\CertificationCode;
use App\UseCase\PasswordReset\CompletePasswordReset\Input;
use App\UseCase\PasswordReset\CompletePasswordReset\Interactor;

$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
$inputs = json_decode(file_get_contents('php://input'), true);
$id = (int) $_SESSION['user_id'];
$email = $_SESSION['email'];

$password = new Password($inputs['newPassword']);
$userId = new UserId($id);
$userEmail = new Email($email);
$certificationCode = new CertificationCode($session->passwordCertificationCode(), $userEmail);
$useCaseInput = new Input($password, $userId, $userEmail, $certificationCode);
$useCaseInteractor = new Interactor($useCaseInput, new PasswordResetCertificationRepository());
$useCaseOutput = $useCaseInteractor->handler();

$response = [
    'data' => [
        'status' => $useCaseOutput->isSuccess(),
        'message' => $useCaseOutput->message(),
    ],
];

echo json_encode($response);
die();
