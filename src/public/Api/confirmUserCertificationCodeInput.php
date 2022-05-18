<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\CertificationCodeDao;
use App\Lib\Session;
use App\Domain\ValueObject\UserId;

$session = Session::getInstance();
$email = $session->certificateEmail();
date_default_timezone_set('Asia/Tokyo');

$certificationCode = json_decode(file_get_contents('php://input'), true);
$emailCertificationCode = $email->value() . $certificationCode['code'];
$hashEmailCertificationCode = hash('sha3-512', $emailCertificationCode);
$certificationCodeDao = new CertificationCodeDao();
$userCertificationCode = $certificationCodeDao->findByCertificationCode(
    $hashEmailCertificationCode
);
if (is_null($userCertificationCode)) {
    $response = [
        'data' => [
            'status' => false,
            'message' => '認証コードが違います!',
        ],
    ];
    echo json_encode($response);
    die();
}
$session->setUserId(new UserId($userCertificationCode['user_id']));

$response = [
    'data' => [
        'status' => true,
        'message' => '認証に成功しました',
        'userId' => $userCertificationCode['user_id'],
        'certificationCode' => $userCertificationCode['certification_code'],
    ],
];
echo json_encode($response);
die();
