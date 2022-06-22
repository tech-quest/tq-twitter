<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Domain\ValueObject\Email;
use App\UseCase\PasswordReset\SearchUserDetail\Input;
use App\UseCase\PasswordReset\SearchUserDetail\Interactor;

date_default_timezone_set('Asia/Tokyo');
header('Content-Type: application/json; charset=UTF-8');

$inputs = json_decode(file_get_contents('php://input'), true);
$email = new Email($inputs['email']);
$useCaseInput = new Input($email);
$useCaseInteractor = new Interactor($useCaseInput);
$useCaseOutput = $useCaseInteractor->handler();
$response = [
    'data' => [
        'email' => $useCaseOutput->email(),
    ],
];
echo json_encode($response);
die();
