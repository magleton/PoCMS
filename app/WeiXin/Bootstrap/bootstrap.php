<?php

use Polymer\Boot\Application;

ini_set("display_errors", 'on');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__, 2));
defined('APP_NAME') || define('APP_NAME', 'WeiXin');
defined('TEMPLATE_PATH') || define('TEMPLATE_PATH', ROOT_PATH . DS . APP_NAME . DS . 'Templates' . DS);
defined('APP_PATH') || define('APP_PATH', ROOT_PATH . DS . APP_NAME . DS);
$loader = require dirname(ROOT_PATH, 1) . DS . 'vendor' . DS . 'autoload.php';

return new Application();