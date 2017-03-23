<?php
//自定义配置
$customer_config = [
    'middleware' => [
        'ip_filter' => \WeChat\Providers\IpFilterProvider::class
    ],
    'ip_list' => ['127.0.0.1']
];

return $customer_config;