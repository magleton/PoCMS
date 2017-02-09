<?php
$app = app()->component('app');
$app->map(['GET' , 'POST'] , "/", APP_NAME."\\Controller\\Home:index")->setName("blog.home.index");
$app->map(['GET' , 'POST'] , "/home/hello", APP_NAME."\\Controller\\Home:hello")->setName("blog.home.hello");
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');

$app->group('/users/{id:[0-9]+}', function () use ($container){
    $this->get('/test' , function () use ($container){
        echo 'aaaaaaaaa';
        //aaaaaaaaaaa
        //dsfsfsf
    })->setName('abc');
    $this->map(['GET', 'DELETE', 'PATCH', 'PUT'], '/user',  APP_NAME."\\Controller\\Home:user")->setName('XXXXhome-user');
    $this->get('/reset-password', APP_NAME."\\Controller\\Home:pwd")->setName('user-password-reset');
});