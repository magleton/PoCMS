<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->get('/admin', APP_NAME . '\\Controller\\Backend\\AdminController:test')->setName('admin.user.test');
