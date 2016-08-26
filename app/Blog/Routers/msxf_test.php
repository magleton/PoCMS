<?php
$app = \Boot\Bootstrap::getApp();
$app->map(['GET' , 'POST'] , "/msxf/test/abc", APP_NAME."\\controller\\msxf\\Test:abc")->setName("blog.msxf.home.index");