<?php
return [
    'app' => [
        'generate_router' => false,
        'providersPath' => [
            'CMS\Providers',
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
        //'rate_limit',
    ],
];
