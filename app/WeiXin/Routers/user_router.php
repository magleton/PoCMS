<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->post('/user/login', APP_NAME . '\\Controller\\Frontend\\UserController:login')->setName('user.login');