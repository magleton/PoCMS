<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->GET('/', APP_NAME . '\\Controller\\Home:index')->setName('wechat.home.root.index');
$app->map(['GET', 'POST'], '/home/add-user', APP_NAME . '\\Controller\\Home:addUser')->setName('wechat.home.add.user');
$app->map(['GET', 'POST'], '/home/send', APP_NAME . '\\Controller\\Home:send')->setName('wechat.home.send');
$app->map(['GET', 'POST'], '/oauth/oAuthWebsite', APP_NAME . '\\Controller\\OAuth:oAuthWebsite')->setName('wechat.OAuth.oAuthWebsite');
$app->map(['GET', 'POST'], '/oauth/dealOAuthWebsite', APP_NAME . '\\Controller\\OAuth:dealOAuthWebsite')->setName('wechat.OAuth.dealOAuthWebsite');
