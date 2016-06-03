<?php
date_default_timezone_set("Asia/Shanghai");
use Boot\Bootstrap;
define("ROOT_PATH" , dirname(dirname(__DIR__)));
define("APP_NAME" , "CMS");
define("APP_PATH", ROOT_PATH."/app/".APP_NAME."/");
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
// 导入自定义函数
require APP_PATH . '/lib/func.inc.php';
Bootstrap::start();