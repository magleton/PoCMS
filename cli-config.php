<?php
define("ROOT_PATH", __DIR__);
define("APP_NAME", "Blog");
define("APP_PATH", ROOT_PATH . "/app/" . APP_NAME . "/");
define("DATA_PATH", ROOT_PATH . "/app/Blog/");
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'production');

$app = new \Core\Boot\Application();
$app->startConsole();
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(\Core\Utils\CoreUtils::getDbInstance(\Core\Utils\CoreUtils::ENTITY, 'db1'));
