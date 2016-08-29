<?php
$app = \boot\Bootstrap::getPimple("app");
$app->addRoutes(array(
    '/' => "Home:index",
    "/hello/:name" => "Home:hello"
));