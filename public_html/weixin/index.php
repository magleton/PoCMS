<?php

use Polymer\Boot\Application;
ini_set("display_errors", 'on');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
define('ROOT_PATH', dirname(__DIR__, 2));
const APP_NAME = 'WeiXin';
const TEMPLATE_PATH = ROOT_PATH . '/app/' . APP_NAME . '/Templates/';
const APP_PATH = ROOT_PATH . '/app/' . APP_NAME . '/';
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
$app = new Application();
try {
    $app->start();
} catch (Exception $e) {
}
