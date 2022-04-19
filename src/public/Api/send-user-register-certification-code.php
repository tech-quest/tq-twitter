<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Lib\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Tokyo');
Dotenv::createImmutable(__DIR__ . '/../../')->load();

$userInput = json_decode(file_get_contents('php://input'), true);
$userDao = new UserDao();
$user = $userDao->findByEmail($userInput['email']);
$email = $userInput['email'];
if (!is_null($user)) {
    $response = [
        'data' => [
            'status' => false,
            'message' => 'メールアドレスが登録されています。',
        ],
    ];
    echo json_encode($response);
    die();
}

$signUpCertificationCode = new SignUpCertificationCode($email);
$certificationCode = $signUpCertificationCode->generateCode();
$hashCertificationCode = $signUpCertificationCode->generateHash(
    $certificationCode
);
$userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
$userRegisterCertificationCodeDao->insertRegisterCertification(
    $hashCertificationCode
);
$session->setRegisterCertificateEmail(new Email($userInput['email']));
$session->setUserName(new Name($userInput['name']));
$session->setHashCertificateEmail($hashCertificationCode);

try {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
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
    $mail->Subject = 'アカウント認証';
    $mail->Body = <<<EOF
  以下の認証コードを使ってプロセスを完了してください。
  アカウントの作成にお心当たりがない場合はこのメールを無視してください。

  認証コード : {$certificationCode}

EOF;
    //送信
    $mail->send();

    // echo 'send';
} catch (Exception $e) {
    // echo 'error:' . $mail->ErrorInfo;
}

$response = [
    'data' => [
        'status' => true,
        'message' => 'まだ登録されていないメールアドレスです。',
    ],
];
echo json_encode($response);
