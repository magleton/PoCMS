<?php
$app = \Boot\Bootstrap::getApp();
$app->map(['GET' , 'POST'] , "/", APP_NAME."\\controller\\Home:index")->setName("blog.home.index");