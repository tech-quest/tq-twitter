<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\Lib\Session;

$session = Session::getInstance();
$name = $_SESSION['name'];
$email = $_SESSION['certificate_register_email'];

date_default_timezone_set('Asia/Tokyo');
// header('Content-Type: application/json; charset=UTF-8'); //ヘッダー情報の明記。必須。
/**
 * POST通信でもグローバル変数「$_POST」からは値を参照できない点に注意してください。
 * その代わり、「php://input」より受け取ったデータを参照することができます。
 */
$certificationCode = json_decode(file_get_contents('php://input'), true);
$emailCertificationCode = $email . $certificationCode['code'];
$hashEmailCertificationCode = hash('sha3-512', $emailCertificationCode);
$userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
$userRegisterCertificationCode = $userRegisterCertificationCodeDao->findByRegisterCertificationCode(
    $hashEmailCertificationCode
);

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
