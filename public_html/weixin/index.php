<?php
date_default_timezone_set('Asia/Shanghai');
define('ROOT_PATH', dirname(dirname(__DIR__)));
define('APP_NAME', 'WeiXin');
define('TEMPLATE_PATH', ROOT_PATH . '/app/' . APP_NAME . '/Templates/');
define('APP_PATH', ROOT_PATH . '/app/' . APP_NAME . '/');
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
$app = new \Polymer\Boot\Application();
$app->start();
