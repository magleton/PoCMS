<?php
$app->map(['GET', 'POST'], '/', APP_NAME . '\\Controller\\Home:index')->setName(APP_NAME . '.home.index');
$app->map(['GET', 'POST'], '/birthday/birthday', APP_NAME . '\\Controller\\Birthday:birthday')->setName(APP_NAME . '.birthday.birthday');
