<?php

namespace WeiXin\Services\Impl;

use DI\Annotation\Injectable;
use WeiXin\Dto\UserLoginDto;
use WeiXin\Services\UserService;

/**
 * @Injectable
 * Class UserServiceImpl
 * @package WeiXin\Services\Impl
 */
class UserServiceImpl implements UserService
{
    /**
     * 用户登录
     * @param string $username
     * @param string $password
     * @return string
     */
    /**
     * 用户登录
     * @param UserLoginDto $userLoginDto
     * @return string
     */
    public function login(UserLoginDto $userLoginDto): string
    {
        $username = $userLoginDto->get('username');
        $password = $userLoginDto->get('password');
        return 'Token Login' . ' : ' . $username . ' : ' . $password;
    }
}