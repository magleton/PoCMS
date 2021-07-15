<?php

namespace WeiXin\Services;

use Polymer\DTO\BaseDTO;
use WeiXin\Dto\UserLoginDto;

interface UserService
{
    /**
     * 用户登录
     * @param UserLoginDto $userLoginDto
     * @return string
     */
    public function login(UserLoginDto $userLoginDto): string;
}