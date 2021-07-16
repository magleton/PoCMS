<?php

namespace WeiXin\Services;

/**
 * Banner服务
 * Interface BannerService
 * @package WeiXin\Services
 */
interface BannerService
{
    /**
     * 新增banner
     * @return int
     */
    public function addBanner(): int;
}