<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Lib\Redirect;

session_start();
unset($_SESSION['auth']);

Redirect::handler('/signin.php');
