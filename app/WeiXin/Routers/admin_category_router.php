<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/category/save', APP_NAME . '\\Controller\\Backend\\CategoryController:save')->setName('admin.category.save');
$app->POST('/category/update', APP_NAME . '\\Controller\\Backend\\CategoryController:update')->setName('admin.category.update');
$app->POST('/category/list', APP_NAME . '\\Controller\\Backend\\CategoryController:list')->setName('admin.category.list');
$app->POST('/category/detail/{id}', APP_NAME . '\\Controller\\Backend\\CategoryController:detail')->setName('admin.category.detail');
