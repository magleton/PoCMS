<?php

use Polymer\Boot\Application;
use Slim\App;

$app = Application::getInstance()->get(App::class);
$app->POST('/admin/upload', APP_NAME . '\\Controller\\Backend\\UploadController:uploadFile')->setName('admin.upload.file');