<?php
 use Polymer\Boot\Application;
$app = Application::getInstance()->component("app");
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index')->setName('debugger.router');
$app->get('/debugger', APP_NAME . '\\Controller\\Debugger:debugger')->setName(APP_NAME . '.debugger.debugger');

$app->get('/hello/index', APP_NAME . '\\Controller\\Hello:index')->setName(APP_NAME . '.hello.index');

$app->map(['GET', 'POST'], '/', APP_NAME . '\\Controller\\Home:index')->setName(APP_NAME . '.home.index');
$app->map(['GET', 'POST'], '/home/hello', APP_NAME . '\\Controller\\Home:hello')->setName(APP_NAME . '.home.hello');
$app->map(['GET', 'POST'], '/home/producer', APP_NAME . '\\Controller\\Home:producer')->setName(APP_NAME . '.home.producer');

