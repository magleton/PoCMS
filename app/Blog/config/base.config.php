<?php
//应用基础配置
$base_config = [
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
                'name' => 'WAP',
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


    // Cookie的配置
    'cookies' => array(
        'expires' => '60 minutes',
        'path' => '/',
        'domain' => null,
        // 'secure' => true,
        'httponly' => true,
        'name' => 'xiaofei_wap',
        'secret' => '1352e241ea67cf9ff69ac9a5f2ae4b47',
        'cipher' => MCRYPT_RIJNDAEL_256,
        'cipher_mode' => MCRYPT_MODE_CBC,
    ),

    // Session的配置
    'session' => array(
        'manager' => array(
            'remember_me_seconds' => 1200,
            'name' => 'xiaofei_wap',
            // 'phpSaveHandler' => 'redis',
            // 'savePath' => 'tcp://127.0.0.1:6379?weight=1&timeout=1',
            'use_cookies' => true,
        ),
        'container' => array(
            'namespace' => 'xiaofei_wap',
        ),
    ),
];

return $base_config;