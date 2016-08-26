<?php
//缓存的配置
$cache = [
    'cache' => array(
        'memcache' => array(
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
        ),
        "redis" => array(
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
        ),
        "memcached" => array(),
    ),
];

return $cache;