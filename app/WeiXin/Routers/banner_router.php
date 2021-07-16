<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->GET('/banner/list', APP_NAME . '\\Controller\\Backend\\BannerController:bannerList')->setName('banner.list');