<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;
use Doctrine\ORM\ORMException;
use Polymer\Service\Service;
use WeiXin\Dto\SearchDto;
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
     * @param SearchDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(SearchDto $bannerDto): int
    {
        $this->bannerModel->save($bannerDto);
        return 19;
    }

    /**
     * 修改banner
     * @param SearchDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function update(SearchDto $bannerDto): int
    {
        $this->bannerModel->update($bannerDto);
        return 19;
    }

    /**
     * banner列表
     * @param SearchDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function list(SearchDto $bannerDto): array
    {
        $this->bannerModel->list($bannerDto);
        return [];
    }

    /**
     * banner详细信息
     * @param $id
     * @return array
     */
    public function detail($id): array
    {
        return $this->bannerModel->detail($id);
    }
}