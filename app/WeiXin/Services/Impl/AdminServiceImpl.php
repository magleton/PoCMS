<?php


namespace WeiXin\Services\Impl;


use WeiXin\Services\AdminService;

/**
 * @Injectable
 *
 * Class AdminServiceImpl
 * @package WeiXin\Services\Impl
 */
class AdminServiceImpl implements AdminService
{
    function test(): string
    {
        return "hello";
        // TODO: Implement test() method.
    }
}