<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;
use Polymer\Service\Service;
use WeiXin\Dto\BannerDto;
use WeiXin\Models\BannerModel;

/**
 * Banner服务
 * @Injectable
 * class BannerService
 * @package WeiXin\Services
 */
class BannerService extends Service
{
    /**
     * @Inject()
     * @var BannerModel
     */
    private BannerModel $bannerModel;

    /**
     * 新增banner
     * @return int
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(): int
    {
        $this->bannerModel->save(new BannerDto(['filename'=>'aaaaa','url'=>'http']));
        return 19;
    }
}