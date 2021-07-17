<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/news/save', APP_NAME . '\\Controller\\Backend\\NewsController:save')->setName('admin.news.save');
$app->POST('/news/update', APP_NAME . '\\Controller\\Backend\\NewsController:update')->setName('admin.news.update');
$app->POST('/news/list', APP_NAME . '\\Controller\\Backend\\NewsController:list')->setName('admin.news.list');
$app->POST('/news/detail/{id}', APP_NAME . '\\Controller\\Backend\\NewsController:detail')->setName('admin.news.detail');
