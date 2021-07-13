<?php

use Polymer\Boot\Application;

error_reporting(E_ALL);
ini_set("display_errors", 'on');
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
date_default_timezone_set('Asia/Shanghai');
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__, 2));
defined('APP_NAME') || define('APP_NAME', 'CMS');
defined('TEMPLATE_PATH') || define('TEMPLATE_PATH', ROOT_PATH . DS . 'app' . DS . APP_NAME . DS . 'Templates' . DS);
defined('APP_PATH') || define('APP_PATH', ROOT_PATH . DS . 'app' . DS . APP_NAME . DS);
require ROOT_PATH . '/vendor/autoload.php';
$app = new Application();
try {
    $app->run();
} catch (Exception $e) {
}
