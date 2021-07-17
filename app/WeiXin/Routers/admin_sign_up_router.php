<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/sign-up/save', APP_NAME . '\\Controller\\Backend\\SignUpController:save')->setName('admin.sign.up.save');
$app->POST('/sign-up/update', APP_NAME . '\\Controller\\Backend\\SignUpController:update')->setName('admin.sign.up.update');
$app->POST('/sign-up/list', APP_NAME . '\\Controller\\Backend\\SignUpController:list')->setName('admin.sign.up.list');
$app->POST('/sign-up/detail/{id}', APP_NAME . '\\Controller\\Backend\\SignUpController:detail')->setName('admin.sign.up.detail');
