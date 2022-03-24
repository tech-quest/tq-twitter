<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\UserDao;
use App\Adapter\QueryService\CertificationCodeQueryService;
use App\Lib\Session;

$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
header('Content-Type: application/json; charset=UTF-8');
$password = json_decode(file_get_contents('php://input'), true);
$id = $_SESSION['user_id'];
$passwordHash = password_hash($password['newPassword'], PASSWORD_DEFAULT);
$user = new UserDao();
$newPassword = $user->updatePassword($id, $passwordHash);

$queryService = new CertificationCodeQueryService();
$result = $queryService->deleteByCertificationCode($id);

$status = [
    'data' => [
        'result' => $result,
    ],
];

echo json_encode($status);
die();
