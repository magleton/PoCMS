<?php

use Monolog\Logger;

ini_set("display_errors", "on");
error_reporting(E_ALL);
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
$app = require dirname(__DIR__, 2) . DS . 'app' . DS . 'WeiXin' . DS . 'Bootstrap' . DS . 'bootstrap.php';
try {
    $app->run();
} catch (Exception $e) {
    $app->get(Logger::class)->error($e);
}
