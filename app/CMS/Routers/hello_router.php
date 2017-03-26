<?php
$app->get('/hello/show', APP_NAME . '\\Controller\\Hello:show')->setName(APP_NAME . '.hello.show');
