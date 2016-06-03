<?php
// 整个引用的配置
$config = array(
    // 自定义的配置(额外的配置)
    'customer' => [
        'use_session_cookie_middleware' => true,
        'show_use_memory' => true,
        'query_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        'result_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        'is_check_login' => 0, //是否打开登录检测
        'is_check_permission' => 0, //是否打开权限管理检测
    ],

    //Pimple 容器的配置
    'pimpleConfig' => array(),

    //缓存的配置
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

    // 应用的配置
    'slim' => array(
        'mode' => APPLICATION_ENV,
        'notFoundHandler' => "notFound",
        "errorHandler" => "errorHandler",
        "notAllowedHandler" => "notAllowedHandler",
        'settings' => [
            'determineRouteBeforeAppMiddleware' => false,
            'displayErrorDetails' => true,
            'logger' => [
                'name' => 'slim-app',
                'level' => Monolog\Logger::DEBUG,
                'path' => APP_PATH . 'log/error.log',
            ]
        ],
    ),

    // 配置模板实例
    'twig' => array(
        'charset' => 'utf-8',
        //'cache' => APP_PATH . '/templates/cache',
        /*'strict_variables' => false,
        'autoescape' => true,*/
        'strict_variables' => false,
        'debug' => true,
        'auto_reload' => true,
    ),

    // 配置事件监听器与事件订阅者
    'evm' => array(
        "listener" => array(
            "Events::prePersist" => 'Admin\listener\MyEventListener',
        ),
        'subscriber' => array(
            "" => "Admin\subscriber\MyEventSubscriber",
        ),
    ),

    // Cookie的配置
    'cookies' => array(
        'expires' => '60 minutes',
        'path' => '/',
        'domain' => null,
        // 'secure' => true,
        'httponly' => true,
        'name' => 'macro_php',
        'secret' => 'changethiskeytosomethingelseasap',
        'cipher' => MCRYPT_RIJNDAEL_256,
        'cipher_mode' => MCRYPT_MODE_CBC,
    ),

    // Session的配置
    'session' => array(
        'manager' => array(
            'remember_me_seconds' => 1200,
            'name' => 'macro_php',
            // 'phpSaveHandler' => 'redis',
            // 'savePath' => 'tcp://127.0.0.1:6379?weight=1&timeout=1',
            'use_cookies' => true,
        ),
        'container' => array(
            'namespace' => 'macro_php',
        ),
    ),

    // 数据库配置
    'db' => array(
        // 开发模式
        'development' => array(
            "db1" => array(
                'wrapperClass' => 'Doctrine\DBAL\Sharding\PoolingShardConnection',
                'shardChoser' => 'Doctrine\DBAL\Sharding\ShardChoser\MultiTenantShardChoser',
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'root',
                'password' => 'root',
                'dbname' => 'feidai',
                "charset" => "UTF8",
                'global' => array(
                    'driver' => 'pdo_mysql',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'dbname' => 'feidai',
                    'user' => 'root',
                    'password' => 'root',
                    'charset' => 'UTF8'
                ),
                'shards' => array(
                    array(
                        'id' => 1,
                        'driver' => 'pdo_mysql',
                        'host' => '127.0.0.1',
                        'user' => 'root',
                        'password' => 'root',
                        'dbname' => 'feidai',
                        'charset' => 'UTF8',
                        'port' => 3306
                    ),
                    array(
                        'id' => 2,
                        'driver' => 'pdo_mysql',
                        'host' => '127.0.0.1',
                        'user' => 'root',
                        'password' => 'root',
                        'dbname' => 'test',
                        'charset' => 'UTF8',
                        'port' => 3306
                    )
                ),
                "useSimpleAnnotationReader" => true,
            ),
            "db2" => array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'root',
                'password' => 'root',
                'dbname' => 'feidai',
                "charset" => "UTF8",
                'sharding' => array(
                    'federationName' => 'my_database',
                    'distributionKey' => 'customer_id',
                ),
                "useSimpleAnnotationReader" => false
            ),
            "db3" => array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'root',
                'password' => 'root',
                'dbname' => 'feidai',
                "charset" => "UTF8",
                'sharding' => array(
                    'federationName' => 'my_database',
                    'distributionKey' => 'customer_id',
                ),
                "useSimpleAnnotationReader" => true
            )),
        // 生产模式
        'production' => array(
            "db1" => array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'root',
                'password' => 'root',
                'dbname' => 'feidai',
                "charset" => "UTF8",
                'sharding' => array(
                    'federationName' => 'my_database',
                    'distributionKey' => 'customer_id',
                ),
                "useSimpleAnnotationReader" => false
            ),
            "db2" => array(
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'username',
                'password' => 'password',
                'dbname' => 'production_dbname',
                "charset" => "UTF8",
                'sharding' => array(
                    'federationName' => 'my_database',
                    'distributionKey' => 'customer_id',
                ),
                "useSimpleAnnotationReader" => true
            )
        ),
    ),

    // 没有权限访问URL跳转到的默认地址
    'default.url' => '/home/index',
);

return $config;
