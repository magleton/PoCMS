<?php
date_default_timezone_set('Asia/Shanghai');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(dirname(__DIR__)));
define('APP_NAME', 'CMS');
define('TEMPLATE_PATH', ROOT_PATH . DS . 'app' . DS . APP_NAME . DS . 'Templates' . DS);
define('APP_PATH', ROOT_PATH . DS . 'app' . DS . APP_NAME . DS);
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
$app = new \Polymer\Boot\Application();
$app->start();
