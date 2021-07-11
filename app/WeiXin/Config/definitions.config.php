<?php

use Polymer\Model\Model;
use WeiXin\Models\UserModel;
use WeiXin\Services\HelloService;
use WeiXin\Services\TestService;

return [
    "testService" => DI\create(TestService::class),
    "helloService" => DI\create(HelloService::class)
];