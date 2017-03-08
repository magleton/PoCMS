<?php
//自定义配置
$customer_config = [
    'middleware' => [
        //\Polymer\Middleware\IpFilterMiddleware::class
        //\Blog\Providers\IpFilterService::class,
        //'checkLogin',
        'ip_filter'=>\Blog\Providers\IpFilterProvider::class
    ],
    'ip_list' => ['127.0.0.1']
];

return $customer_config;