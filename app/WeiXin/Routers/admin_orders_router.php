<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/order/save', APP_NAME . '\\Controller\\Backend\\OrderController:save')->setName('admin.order.save');
$app->POST('/order/update', APP_NAME . '\\Controller\\Backend\\OrderController:update')->setName('admin.order.update');
$app->POST('/order/list', APP_NAME . '\\Controller\\Backend\\OrderController:list')->setName('admin.order.list');
$app->POST('/order/detail/{id}', APP_NAME . '\\Controller\\Backend\\OrderController:detail')->setName('admin.order.detail');
