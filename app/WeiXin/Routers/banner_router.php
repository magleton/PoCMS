<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/banner/save', APP_NAME . '\\Controller\\Backend\\BannerController:save')->setName('banner.save');