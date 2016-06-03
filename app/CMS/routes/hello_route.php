<?php
$app = \boot\Bootstrap::getPimple("app");

$app->map("/hello/show(/:name)", APP_NAME."\\controller\\Hello:show")
    ->via('GET', 'POST', 'PUT')
    ->name('show')->setMiddleware([function () {
        echo __FILE__;
    }]);

/*$app->map("/hello/test", "controller\\Hello:test")->via("GET")->name("test");

$app->map("/hello/index", "controller\\Hello:index")
    ->via("GET")
    ->setMiddleware([
    function () {
        echo "12345";
    },
    function () {
        echo "333333333";
    }
])->name("index");

$app->map("/hello/rbac", "controller\\Hello:rbac")
    ->via("POST")
    ->name("rbac"); */
