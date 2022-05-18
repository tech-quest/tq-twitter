<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\UseCase\SignUp\SendUserRegisterCertificationCode\Input;
use App\UseCase\SignUp\SendUserRegisterCertificationCode\Interactor;

date_default_timezone_set('Asia/Tokyo');
Dotenv::createImmutable(__DIR__ . '/../../')->load();

$userInput = json_decode(file_get_contents('php://input'), true);
$name = new Name($userInput['name']);
$email = new Email($userInput['email']);
$useCaseInput = new Input($name, $email);
$useCaseInteractor = new Interactor($useCaseInput);
$output = $useCaseInteractor->handler();
$response = [
    'data' => [
        'status' => $output->isSuccess(),
        'message' => $output->message(),
    ],
];
echo json_encode($response);
die();
