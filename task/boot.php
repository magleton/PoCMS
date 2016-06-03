<?php
define("ROOT_PATH" , dirname(__DIR__));
define("APP_NAME" , "Task");
define("APP_PATH", __DIR__);
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
// 导入自定义函数
define('HOST', 'localhost');
define('PORT', 5672);
define('USER', 'guest');
define('PASS', 'guest');
define('VHOST', '/');
//If this is enabled you can see AMQP output on the CLI
define('AMQP_DEBUG', true);
\Boot\Bootstrap::startConsole();