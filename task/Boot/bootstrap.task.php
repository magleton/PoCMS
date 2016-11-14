<?php
/**
 * TASK的配置与启动
 * User: macro
 * Date: 16-4-29
 * Time: 上午10:42
 */
date_default_timezone_set('Asia/Shanghai');
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
define('ROOT_PATH', dirname(dirname(__DIR__)));
define('APP_NAME', 'task');
define('APP_PATH', ROOT_PATH . '/' . APP_NAME . '/');
define('CONFIG_PATH', ROOT_PATH . '/' . APP_NAME . '/');
require ROOT_PATH . '/vendor/autoload.php';
$app = new \Polymer\Boot\Application();
$app->startConsole();
