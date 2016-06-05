<?php
//自定义配置
$customer_config = [
    // 自定义的配置(额外的配置)
    'customer' => [
        'use_seesioncookie_middleware' => true,
        'show_use_memory' => false,
        'doctrine_query_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        'doctrine_result_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        'doctrine_metadata_cache' => [
            'is_open' => true,
            'cache_name' => 'redisCacheDriver'
        ],
        //定义数据缓存的Cache
        'data_cache' => [
            'redis_cache' => [
                'is_open' => true,
                'cache_name' => 'redisCache'
            ],
            'memcache_cache' => [
                'is_open' => true,
                'cache_name' => 'memcacheCache'
            ],
        ],
        //设置配置文件的缓存
        'config_cache' => [
            'is_open' => true,
            'cache_name' => 'memcacheCache'
        ],
        'encrypt_key' => '50966aa77700771034fd2bbc69d0bec9',//加密的KEY
        'is_check_login' => false, //是否打开登录检测
        'is_check_permission' => true, //是否打开权限管理检测
        'is_rest' => true, //接口形式提供服务
        'is_cross_domain' => true, //跨域响应头部的处理
        'is_open_socket_log_debug' => true,  //是否打开SoLog调试
    ],

    //Memcache,Redis缓存的命名空间
    'cache_namespace' => [
        'submit_order_namespace' => 'submit_order_namespace',
        'order_namespace' => 'order_namespace',
        'user_namespace' => '',
        'push_order_namespace' => '',
        'msxf_namespace' => 'msxf_memcache_namespace'  //马上消费的命名空间
    ],

    //Redis缓存的key
    'redis_keys' => [
        'default_queue_key' => 'task',
        'submit_order_queue_key' => 'submit_order'
    ],

    'socket_log' => [
        'enable' => true,//是否打印日志的开关
        'host' => 'slog.thinkphp.cn',//websocket服务器地址，默认localhost
        'optimize' => false,//是否显示利于优化的参数，如果运行时间，消耗内存等，默认为false
        'show_included_files' => false,//是否显示本次程序运行加载了哪些文件，默认为false
        'error_handler' => true,//是否接管程序错误，将程序错误显示在console中，默认为false
        'force_client_id' => 'slog_269e56',//日志强制记录到配置的client_id,默认为空
        'allow_client_ids' => ['slog_269e56', 'slog_f7646b'],////限制允许读取日志的client_id，默认为空,表示所有人都可以获得日志。
    ],
    // 没有权限访问URL跳转到的默认地址
    'default.url' => '/home/index',
];

return $customer_config;