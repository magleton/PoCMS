<?php
$app->map(['GET', 'POST'], '/', APP_NAME . '\\Controller\\Home:index')->setName(APP_NAME . '.home.index');
