<?php
//自定义配置
$customer_config = [
    'middleware' => [
        'ssss' => stdClass::class,
        'checkLogin' => stdClass::class,
        'sessionMiddleware' => \Core\Middleware\SessionMiddleware::class,
    ],
];

return $customer_config;