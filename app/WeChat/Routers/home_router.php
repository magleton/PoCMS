<?php
$app->map(['GET' , 'POST'] , "/", APP_NAME."\\Controller\\Home:index")->setName("blog.home.index");
$app->map(['GET' , 'POST'] , "/home/hello", APP_NAME."\\Controller\\Home:hello")->setName("blog.home.hello");
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');
