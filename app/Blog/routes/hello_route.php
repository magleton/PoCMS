<?php
$app = \Boot\Bootstrap::getApp();

$app->get("/hello/show", "Blog\controller\Hello:show")->setName("hello.show");

/*$app->map("/hello/test(/)(:name)", APP_NAME."\\controller\\Hello:test")->via("GET")->name("test");

$app->map("/hello/index", APP_NAME."\\controller\\Hello:index")
    ->via("GET")
    ->setMiddleware([
    function () {
        echo "12345";
    },
    function () {
        echo "333333333";
    }
])->name("index");

$app->map("/hello/rbac", APP_NAME."\\controller\\Hello:rbac")
    ->via("POST")
    ->name("rbac");*/
