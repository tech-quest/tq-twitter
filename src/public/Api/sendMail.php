<?php
ini_set('display_errors', 1);
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Lib\Session;
use App\Domain\ValueObject\Email;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\CertificationCodeDao;
use App\UseCase\PasswordReset\PasswordCertificationSender;

Dotenv::createImmutable(__DIR__ . '/../../')->load();
date_default_timezone_set('Asia/Tokyo');
header('Content-Type: application/json; charset=UTF-8'); //ヘッダー情報の明記。必須。

/**
 * POST通信でもグローバル変数「$_POST」からは値を参照できない点に注意してください。
 * その代わり、「php://input」より受け取ったデータを参照することができます。
 */
$userEmail = json_decode(file_get_contents('php://input'), true);
$userDao = new UserDao();
$user = $userDao->findByEmail($userEmail['input']);

$certificationCode = chr(mt_rand(97, 122));
for ($i = 0; $i < 10; $i++) {
    $certificationCode .= chr(mt_rand(97, 122));
}

$emailCertificationCode = $user['email'] . $certificationCode;
$hashCertificationCode = hash('sha3-512', $emailCertificationCode);
$certificationCodeDao = new CertificationCodeDao();
$certificationCodeDao->insertPasswordCertification(
    $user['id'],
    $hashCertificationCode
);

$session = Session::getInstance();
$session->setCertificateEmail(new Email($user['email']));

try {
    $passwordCertificationSender = new PasswordCertificationSender(
        $user,
        $certificationCode
    );
    $passwordCertificationSender->sendMail();
} catch (Exception $e) {
    echo 'error:' . $mail->ErrorInfo;
}
