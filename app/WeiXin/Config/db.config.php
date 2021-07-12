<?php
//数据库配置
use Doctrine\ORM\Mapping\DefaultNamingStrategy;
use Doctrine\DBAL\Sharding\PoolingShardConnection;
use Doctrine\DBAL\Sharding\ShardChoser\MultiTenantShardChoser;

return [
    'db' => array(
        // 开发模式
        'development' => array(
            "db1" => array(
                'wrapperClass' => PoolingShardConnection::class,
                'namingStrategy' => DefaultNamingStrategy::class,
                'shardChoser' => MultiTenantShardChoser::class,
                'driver' => 'pdo_mysql',
                'host' => '192.168.56.101',
                'port' => 3306,
                'user' => 'britton',
                'password' => 'britton',
                'dbname' => 'mydb',
                "charset" => "UTF8",
                'global' => array(
                    'driver' => 'pdo_mysql',
                    'host' => '192.168.56.101',
                    'port' => 3306,
                    'dbname' => 'mydb',
                    'user' => 'britton',
                    'password' => 'britton',
                    'charset' => 'UTF8'
                ),
                'shards' => array(
                    array(
                        'id' => 1,
                        'driver' => 'pdo_mysql',
                        'host' => '10.0.25.2',
                        'user' => 'root',
                        'password' => '111111',
                        'dbname' => 'xiaofei',
                        'charset' => 'UTF8',
                        'port' => 3308
                    ),
                    array(
                        'id' => 2,
                        'driver' => 'pdo_mysql',
                        'host' => '10.0.25.2',
                        'user' => 'root',
                        'password' => '111111',
                        'dbname' => 'test',
                        'charset' => 'UTF8',
                        'port' => 3308
                    )
                ),
                "useSimpleAnnotationReader" => false,
                'emCacheKey' => 'abc',
            ),

            "db2" => array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'root',
                'password' => 'root',
                'dbname' => 'xiaofei',
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
                'dbname' => 'xiaofei',
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
                'dbname' => 'xiaofei',
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
];