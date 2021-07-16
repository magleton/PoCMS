<?php

namespace WeiXin\Services\Impl;

use DI\Annotation\Injectable;
use WeiXin\Services\BannerService;

/**
 * @Injectable
 * Class BannerServiceImpl
 * @package WeiXin\Services\Impl
 */
class BannerServiceImpl implements BannerService
{
    /**
     * @return int
     */
    public function addBanner(): int
    {
        echo '这个是banner 列表！！！';
        return 0;
    }
}