<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\TweetDao;
use App\Lib\Session;

date_default_timezone_set('Asia/Tokyo');
$input = json_decode(file_get_contents('php://input'), true);

$session = Session::getInstance();
$id = $_SESSION['user_id'];
$device = $_SESSION['device'];
$replyTweetId = 4;
$tweetsDao = new TweetDao();
$tweetsDao->insert($id, $input['tweet'], $replyTweetId, $device);

if ($tweetsDao) {
    $response = [
        'data' => [
            'status' => true,
        ],
    ];
    echo json_encode($response);
}
