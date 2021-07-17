<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/scenic-spot-plan/save', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:save')->setName('admin.scenic.spot.plan.save');
$app->POST('/scenic-spot-plan/update', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:update')->setName('admin.scenic.spot.plan.update');
$app->POST('/scenic-spot-plan/list', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:list')->setName('admin.scenic.spot.plan.list');
$app->POST('/scenic-spot-plan/detail/{id}', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:detail')->setName('admin.scenic.spot.plan.detail');
