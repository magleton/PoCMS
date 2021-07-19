<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/admin/login', APP_NAME . '\\Controller\\Backend\\AdminController:login')->setName('admin.login');
$app->POST('/admin/getAdminInfo', APP_NAME . '\\Controller\\Backend\\AdminController:getAdminInfo')->setName('admin.getAdminInfo');
