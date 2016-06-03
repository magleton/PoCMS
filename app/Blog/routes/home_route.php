<?php
$app = \boot\Bootstrap::getPimple("app");
$app->map("/", APP_NAME."\\controller\\Home:index")->via("GET");;
/* $app->addRoutes(array(
    '/' => array("Home:index",function(){
        echo "aggagag";
    }),
    "/hello/:name"=> array('POST' => array("Home:hello",function () {
        echo "12345";
    } , function(){
        echo "45656656";return ;
    }))
),array('mw1' , 'mw2')); */