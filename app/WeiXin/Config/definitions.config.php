<?php

use WeiXin\Services\AdminService;
use WeiXin\Services\HelloService;
use WeiXin\Services\Impl\AdminServiceImpl;
use WeiXin\Services\Impl\UserServiceImpl;
use WeiXin\Services\TestService;
use WeiXin\Services\UserService;

return [
    'testService' => DI\create(TestService::class),
    'helloService' => DI\create(HelloService::class),
    AdminService::class => DI\create(AdminServiceImpl::class),
    UserService::class => DI\create(UserServiceImpl::class)
];