<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/appointment/save', APP_NAME . '\\Controller\\Backend\\AppointmentController:save')->setName('admin.appointment.save');
$app->POST('/appointment/update', APP_NAME . '\\Controller\\Backend\\AppointmentController:update')->setName('admin.appointment.update');
$app->POST('/appointment/list', APP_NAME . '\\Controller\\Backend\\AppointmentController:list')->setName('admin.appointment.list');
$app->POST('/appointment/detail/{id}', APP_NAME . '\\Controller\\Backend\\AppointmentController:detail')->setName('admin.appointment.detail');
