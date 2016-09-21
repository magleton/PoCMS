<?php
date_default_timezone_set("Asia/Shanghai");

define("ROOT_PATH", dirname(dirname(__DIR__)));
define("APP_NAME", "Blog");
define('TEMPLATE_PATH', ROOT_PATH . "/app/" . APP_NAME . "/Templates/");
define("APP_PATH", ROOT_PATH . "/app/" . APP_NAME . "/");
define("CONFIG_PATH", ROOT_PATH . "/app/" . APP_NAME . "/");
define("MODEL_PATH", ROOT_PATH . "/app/Admin/");
define('CACHE_DIR', ROOT_PATH . "/app/" . APP_NAME . "/");
define('ROUTER_PATH', ROOT_PATH . "/app/" . APP_NAME . "/");
define('ENTITY_NAMESPACE', 'Entity\\Models');//数据模型的命名空间
define("API_MODE", 'test'); //设置马上消费API的模式
define('STATIC_FILE_DIR', dirname(__DIR__) . '/static');
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
$app = new \Core\Boot\Application();
$app->start();