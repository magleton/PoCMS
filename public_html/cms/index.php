<?php

use Polymer\Boot\Application;

ini_set("display_errors", 'on');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
const DS = DIRECTORY_SEPARATOR;
define('ROOT_PATH', dirname(__DIR__, 2));
const APP_NAME = 'CMS';
const TEMPLATE_PATH = ROOT_PATH . DS . 'app' . DS . APP_NAME . DS . 'Templates' . DS;
const APP_PATH = ROOT_PATH . DS . 'app' . DS . APP_NAME . DS;
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
$app = new Application();
try {
    $app->start();
} catch (Exception $e) {
}
