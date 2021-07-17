<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;
use Doctrine\ORM\ORMException;
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
     * @Inject
     * @var BannerModel
     */
    private BannerModel $bannerModel;

    /**
     * 新增banner
     * @param BannerDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(BannerDto $bannerDto): int
    {
        $this->bannerModel->save($bannerDto);
        return 19;
    }

    /**
     * 修改banner
     * @param BannerDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function update(BannerDto $bannerDto): int
    {
        $this->bannerModel->update($bannerDto);
        return 19;
    }

    /**
     * banner列表
     * @param BannerDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function list(BannerDto $bannerDto): array
    {
        $this->bannerModel->list($bannerDto);
        return [];
    }
}