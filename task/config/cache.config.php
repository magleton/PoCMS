<?php
//缓存的配置
$cache = [
    'cache' => [
        'memcache' => [
            'server1' => [
                "host" => "127.0.0.1",
                "port" => 11211,
                'alias' => 'memcache01',
                'timeout' => 10,
                'namespace' => APP_NAME . '-memcache01',
            ],
            'server2' => [
                "host" => "192.168.0.181",
                "port" => 11211,
                'alias' => 'memcache02',
                'timeout' => 10,
                'namespace' => APP_NAME . '-memcache02',
            ]
        ],
        "redis" => [
            'server1' => [
                "host" => "127.0.0.1",
                "port" => 6379,
                'timeout' => 10,
                'alias' => 'redis01',
                'namespace' => APP_NAME . '-redis01',
            ],
            'server2' => [
                "host" => "192.168.0.181",
                "port" => 6379,
                'timeout' => 10,
                'alias' => 'redis02',
                'namespace' => APP_NAME . '-redis02',
            ]
        ],
        "memcached" => [
            'server1' => [
                'host' => '127.0.0.1',
                'port' => 11211,
                'timeout' => 10,
                'weight' => 1,
                'alias' => 'memcached01',
                'namespace' => APP_NAME . '-memcached'
            ],
        ],
    ],
];

return $cache;