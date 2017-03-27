<?php
$app->get('/hello/index', APP_NAME . '\\Controller\\Hello:index')->setName(APP_NAME . '.hello.index');
