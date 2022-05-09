<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\SignUpCertificationCode;
use App\Lib\Session;
use App\UseCase\SignUp\SendCertificationCode\SignUpCertificationSender;

date_default_timezone_set('Asia/Tokyo');
Dotenv::createImmutable(__DIR__ . '/../../')->load();

$userInput = json_decode(file_get_contents('php://input'), true);
$userDao = new UserDao();
$user = $userDao->findByEmail($userInput['email']);
$email = new Email($userInput['email']);

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

$session = Session::getInstance();
$session->setRegisterCertificateEmail($email);
$session->setUserName(new Name($userInput['name']));
$session->setHashCertificateEmail($hashCertificationCode);

try {
    $signUpCertificationSender = new SignUpCertificationSender(
        $certificationCode
    );
    $signUpCertificationSender->send();
} catch (Exception $e) {
    echo 'error:' . $e->getMessage();
}

$response = [
    'data' => [
        'status' => true,
        'message' => 'まだ登録されていないメールアドレスです。',
    ],
];
echo json_encode($response);
