<?php
//自定义配置
$customer_config = [
    'app' => [
        'generate_router' => true,
        'providersPath' => [
            'CMS\Providers',
        ],
        'initial_epoch' => 1476614506000,
    ],
    'middleware' => [
        'checkPermission'
    ],
];

return $customer_config;