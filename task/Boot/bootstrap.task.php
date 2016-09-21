<?php
/**
 * TASK的配置与启动
 * User: macro
 * Date: 16-4-29
 * Time: 上午10:42
 */
date_default_timezone_set("Asia/Shanghai");

define("ROOT_PATH", dirname(dirname(__DIR__)));
define("APP_NAME", "task");
define("CONFIG_PATH", ROOT_PATH . "/app/" . APP_NAME . "/");
define("MODEL_PATH", ROOT_PATH . "/app/Admin/");
define('CACHE_DIR', ROOT_PATH . "/app/" . APP_NAME . "/");
define('ROUTER_PATH', ROOT_PATH . "/app/" . APP_NAME . "/");
define('ENTITY_NAMESPACE', 'Entity\\Models');//数据模型的命名空间
define("API_MODE", 'test'); //设置马上消费API的模式
define('STATIC_FILE_DIR', dirname(__DIR__) . '/static');
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
// 导入自定义函数
require APP_PATH . '/Lib/func.inc.php';
$app = new \Core\Boot\Application();
$app->startConsole();
