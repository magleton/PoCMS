<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/agency/save', APP_NAME . '\\Controller\\Backend\\AgencyController:save')->setName('admin.agency.save');
$app->POST('/agency/update', APP_NAME . '\\Controller\\Backend\\AgencyController:update')->setName('admin.agency.update');
$app->POST('/agency/list', APP_NAME . '\\Controller\\Backend\\AgencyController:list')->setName('admin.agency.list');
$app->POST('/agency/detail/{id}', APP_NAME . '\\Controller\\Backend\\AgencyController:detail')->setName('admin.agency.detail');
