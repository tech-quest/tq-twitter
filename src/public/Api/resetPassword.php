<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Session;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;
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
$useCaseInput = new Input($password, $userId, $userEmail);
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
