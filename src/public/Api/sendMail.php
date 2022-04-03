<?php
ini_set('display_errors', 1);
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Lib\Session;
use App\Domain\ValueObject\Email;
use App\Infrastructure\Dao\UserDao;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
$userDao->insertPasswordCertification($user['id'], $hashCertificationCode);

$session = Session::getInstance();
$session->setCertificateEmail(new Email($user['email']));

try {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAILTRAP_USERNAME'];
    $mail->Password = $_ENV['MAILTRAP_PASSWORD'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    //Recipients
    $mail->setFrom('tq-twitter@example.com', 'Mailer');
    $mail->addAddress('tq-user@example.com', 'Mr To');

    //Content
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'パスワードをリセットしますか？';
    $mail->Body = <<<EOF
  ご利用のTwitterアカウント「{$user['name']}」のパスワードをリセットするには、以下の認証コードを使ってプロセスを完了してください。パスワードのリセットにお心当たりがない場合はこのメールを無視してください。

  認証コード : {$certificationCode}

EOF;
    //送信
    $mail->send();

    echo 'send';
} catch (Exception $e) {
    echo 'error:' . $mail->ErrorInfo;
}
