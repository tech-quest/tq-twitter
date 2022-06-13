<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Lib\Session;
use App\Domain\ValueObject\Password;
use App\Infrastructure\Validator\PasswordInputValidator;

$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
header('Content-Type: application/json; charset=UTF-8');
$inputs = json_decode(file_get_contents('php://input'), true);
$id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$password = new Password($inputs['newPassword']);

$passwordInputError = new PasswordInputValidator($password->value());
if (!is_null($passwordInputError->passwordErrorText())) {
    $response = [
        'data' => [
            'status' => false,
            'message' => '不正な形式のパスワードです'
        ],
    ];
    echo json_encode($response);
    die;
}


$user = new UserDao();
$newPassword = $user->updatePassword($id, $password->hashAsString());
$certificationCodeDao = new CertificationCodeDao();
$result = $certificationCodeDao->deleteByCertificationCode($id);

$response = [
    'data' => [
        'status' => $result,
    ],
];

echo json_encode($response);
die();
