<?php
//自定义配置
$customer_config = [
    // 自定义的配置(额外的配置)
    'customer' => array(
        'use_seesioncookie_middleware' => true,
        'show_use_memory' => false,
        'query_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        'result_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        'is_check_login' => true, //是否打开登录检测
        'is_check_permission' => 0, //是否打开权限管理检测
        'is_rest' => 1, //接口形式提供服务
    ),
    // 配置事件监听器与事件订阅者
    'evm' => array(
        "listener" => array(
            "Events::prePersist" => 'Wap\listener\MyEventListener',
        ),
        'subscriber' => array(
            "" => "Wap\subscriber\MyEventSubscriber",
        ),
    ),
    // 没有权限访问URL跳转到的默认地址
    'default.url' => '/home/index',
];

return $customer_config;