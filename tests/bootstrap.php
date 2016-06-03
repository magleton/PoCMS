<?php
//单元测试的引导文件
date_default_timezone_set("Asia/Shanghai");
use Boot\Bootstrap;

define("ROOT_PATH", dirname(__DIR__));
define("APP_NAME", "Admin");
define("APP_PATH", ROOT_PATH . "/app/" . APP_NAME . "/");
define("DATA_PATH", ROOT_PATH . "/app/Admin/");
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
$config = require APP_PATH . '/config/config.php';
// 导入自定义函数
require APP_PATH . '/lib/func.inc.php';
Bootstrap::startConsole();
