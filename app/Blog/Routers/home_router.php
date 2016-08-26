<?php
$app = \Core\Utils\CoreUtils::getContainer('app');
$app->map(['GET' , 'POST'] , "/", APP_NAME."\\controller\\Home:index")->setName("blog.home.index");