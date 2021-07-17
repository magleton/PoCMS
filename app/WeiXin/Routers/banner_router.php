<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/banner/save', APP_NAME . '\\Controller\\Backend\\BannerController:save')->setName('banner.save');
$app->POST('/banner/update', APP_NAME . '\\Controller\\Backend\\BannerController:update')->setName('banner.update');
$app->POST('/banner/list', APP_NAME . '\\Controller\\Backend\\BannerController:list')->setName('banner.list');
