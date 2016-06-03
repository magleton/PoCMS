<?php
/**
 * TASK的配置与启动
 * User: macro
 * Date: 16-4-29
 * Time: 上午10:42
 */
set_time_limit(0);
date_default_timezone_set("Asia/Shanghai");
use Boot\Bootstrap;

define("ROOT_PATH", dirname(dirname(__DIR__)));
define("APP_NAME", "task");
define('APP_PATH' ,dirname(__DIR__). "/");
define("CONFIG_PATH", dirname(__DIR__). "/");
define("MODEL_PATH", ROOT_PATH . "/app/Admin/");
define('ENTITY_NAMESPACE', 'Admin\\Entity');//数据模型的命名空间
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
// 导入自定义函数
require dirname(__DIR__) . '/lib/func.inc.php';
Bootstrap::startConsole();
