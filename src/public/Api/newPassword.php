<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\Lib\Session;
use App\Domain\ValueObject\Password;

$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
header('Content-Type: application/json; charset=UTF-8');
$inputs = json_decode(file_get_contents('php://input'), true);
$id = $_SESSION['user_id'];
$password = new Password($inputs['newPassword']);
$user = new UserDao();
$newPassword = $user->updatePassword($id, $password->hashAsString());
$certificationCodeDao = new CertificationCodeDao();
$result = $certificationCodeDao->deleteByCertificationCode($id);

$status = [
    'data' => [
        'result' => $result,
    ],
];

echo json_encode($status);
die();
