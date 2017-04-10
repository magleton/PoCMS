<?php
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index')->setName('debugger.router');
$app->get('/debugger', APP_NAME . '\\Controller\\Debugger:debugger')->setName(APP_NAME . '.debugger.debugger');
