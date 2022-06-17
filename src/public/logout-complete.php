<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;
use App\Lib\Session;

$session = Session::getInstance();
$session->clearAuth();

Redirect::handler('/signin.php');
