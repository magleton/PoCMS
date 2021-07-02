<?php
//自定义配置
return [
    'app' => [
        'router_path' => [
            'router' => APP_PATH . 'Cache' . DIRECTORY_SEPARATOR . 'router.php',
            'lock' => APP_PATH . DIRECTORY_SEPARATOR . 'Cache' . DIRECTORY_SEPARATOR . 'router.lock'
        ],
        'router_cache_file' => APP_PATH . 'Cache' . DIRECTORY_SEPARATOR . 'routerCacheFile.router',
        'generate_router' => false,
        'providers_path' => [
            'WeiXin\Providers',
        ],
        'initial_epoch' => 1476614506000,
        //限制IP流量
        'rate_limit' => [
            'limit' => 10,
            'window' => 60 * 60,
            'redis_option' => [
                'host' => '10.0.25.1',
                'port' => 6379,
                'timeout' => 0.0,
            ]
        ]
    ],
    'middleware' => [
        //'initAccessToken',
        //'ip_filter' => \WeChat\Providers\IpFilterProvider::class,
    ],
    'ip_list' => ['127.0.0.1']
];
