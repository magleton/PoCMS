<?php

use Polymer\Boot\Application;

ini_set("display_errors", 'on');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
define('ROOT_PATH', dirname(__DIR__, 2));
const APP_NAME = 'WeiXin';
const TEMPLATE_PATH = ROOT_PATH . DS . APP_NAME . DS . 'Templates' . DS;
const APP_PATH = ROOT_PATH . DS . APP_NAME . DS;
$loader = require dirname(ROOT_PATH, 1) . DS . 'vendor' . DS . 'autoload.php';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');

$app = new Application();
/*$app->register(\Polymer\Providers\AopProvider::class);
$app->register(\Polymer\Providers\GXValidatorProvider::class);
$app->register(IpFilterProvider::class);*/
return $app;