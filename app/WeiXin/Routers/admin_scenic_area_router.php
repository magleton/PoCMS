<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/scenic-area/save', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:save')->setName('admin.scenic.area.save');
$app->POST('/scenic-area/update', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:update')->setName('admin.scenic.area.update');
$app->POST('/scenic-area/list', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:list')->setName('admin.scenic.area.list');
$app->POST('/scenic-area/detail/{id}', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:detail')->setName('admin.scenic.area.detail');
