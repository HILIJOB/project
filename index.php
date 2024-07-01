<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL); 

require_once "bootstrap.php";

use app\core\Api;

$app = new Api();
$app->start();

