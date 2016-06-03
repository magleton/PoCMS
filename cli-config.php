<?php
use Boot\Bootstrap;

define("ROOT_PATH", __DIR__);
define("APP_NAME", "Blog");
define("APP_PATH", ROOT_PATH . "/app/" . APP_NAME . "/");
define("DATA_PATH", ROOT_PATH . "/app/Blog/");
require ROOT_PATH . '/vendor/autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'production');

Bootstrap::startConsole();
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(Bootstrap::getDbInstance('entityManager', 'db1'));
