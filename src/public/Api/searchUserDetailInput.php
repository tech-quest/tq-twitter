<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\UserDao;

date_default_timezone_set('Asia/Tokyo');
header('Content-Type: application/json; charset=UTF-8'); //ヘッダー情報の明記。必須。
/**
 * POST通信でもグローバル変数「$_POST」からは値を参照できない点に注意してください。
 * その代わり、「php://input」より受け取ったデータを参照することができます。
 */
$searchInput = json_decode(file_get_contents('php://input'), true);

$userDao = new UserDao();
$user = $userDao->findByEmail($searchInput['input']);

$status = [
    'data' => [
        'email' => $user['email'],
    ],
];
echo json_encode($status);
die();
