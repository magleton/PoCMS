<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->getDiContainer()->get(App::class);
$app->map(['GET', 'POST'], '/', APP_NAME . '\\Controller\\Home:index')->setName('wechat.home.root.index');
$app->map(['GET', 'POST'], '/home/index', APP_NAME . '\\Controller\\Home:index')->setName('wechat.home.index');
$app->map(['GET', 'POST'], '/home/send', APP_NAME . '\\Controller\\Home:send')->setName('wechat.home.send');
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');
$app->map(['GET', 'POST'], '/oauth/oAuthWebsite', APP_NAME . '\\Controller\\OAuth:oAuthWebsite')->setName('wechat.OAuth.oAuthWebsite');
$app->map(['GET', 'POST'], '/oauth/dealOAuthWebsite', APP_NAME . '\\Controller\\OAuth:dealOAuthWebsite')->setName('wechat.OAuth.dealOAuthWebsite');

