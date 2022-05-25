<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\Lib\Session;

$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
// header('Content-Type: application/json; charset=UTF-8'); //ヘッダー情報の明記。必須。
/**
 * POST通信でもグローバル変数「$_POST」からは値を参照できない点に注意してください。
 * その代わり、「php://input」より受け取ったデータを参照することができます。
 */
$password = json_decode(file_get_contents('php://input'), true);
$name = $_SESSION['name'];
$email = $_SESSION['certificate_register_email'];
$hashCertificateRegisterCode = $_SESSION['hash_certificate_register'];
$passwordHash = password_hash($password['password'], PASSWORD_DEFAULT);
$userDao = new UserDao();
$result = $userDao->insertUser($name, $email, $passwordHash);
$userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
$userRegisterCertificationCodeDao->deleteByRegisterCertificationCode(
  $hashCertificateRegisterCode
);

if ($result === true) {
  $_SESSION = [];
  session_destroy();
}

$status = [
  'data' => [
    'result' => $result,
  ],
];
echo json_encode($status);
die();
