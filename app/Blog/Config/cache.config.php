<?php
//缓存的配置
$cache = [
    'cache' => array(
        'memcache' => array(
            'server1' => [
                'resource_id' => 1,
                'servers' => [
                    [
                        'host' => '127.0.0.1',
                        'port' => 11211,
                        'timeout' => 10,
                    ]
                ],
                //'alias' => 'memcache01',
                'namespace' => APP_NAME . '-memcache01',
            ],
            'server2' => [
                'resource_id' => 2,
                'servers' => [
                    'host' => '192.168.0.181',
                    'port' => 11211,
                    'timeout' => 10,
                ],
                //'alias' => 'memcache02',
                'namespace' => APP_NAME . '-memcache02',
            ]
        ),
        'redis' => [
            'server1' => [
                'resource_id' => 1,
                'server' => [
                    'host' => '127.0.0.1',
                    'port' => 6379,
                    'timeout' => 10,
                ],
                //'alias' => 'redis01',
                'namespace' => APP_NAME . '-redis01',
            ],
            'server2' => [
                'resource_id' => 2,
                'server' => [
                    'host' => "192.168.0.181",
                    'port' => 6379,
                    'timeout' => 10,
                ],
                'alias' => 'redis02',
                'namespace' => APP_NAME . '-redis02',
            ]
        ],
        "memcached" => [
            'server1' => [
                'resource_id' => 1,
                'servers' => [
                    [
                        'host' => '127.0.0.1',
                        'port' => 11211,
                        'timeout' => 10,
                    ]
                ],
                //'alias' => 'memcache01',
                'namespace' => APP_NAME . '-memcache01',
            ],
            'server2' => [
                'resource_id' => 2,
                'servers' => [
                    'host' => '192.168.0.181',
                    'port' => 11211,
                    'timeout' => 10,
                ],
                //'alias' => 'memcache02',
                'namespace' => APP_NAME . '-memcache02',
            ]
        ],
    ),
];

return $cache;