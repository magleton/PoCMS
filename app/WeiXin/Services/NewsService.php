<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Doctrine\ORM\ORMException;
use WeiXin\Dto\BannerDto;
use WeiXin\Models\NewsModel;

/**
 * 新闻服务
 * Interface NewsService
 * @package WeiXin\Services
 */
class NewsService
{
    /**
     * @Inject
     * @var NewsModel
     */
    private NewsModel $newsModel;

    /**
     * 新增banner
     * @param BannerDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(BannerDto $bannerDto): int
    {
        $this->newsModel->save($bannerDto);
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
        $this->newsModel->update($bannerDto);
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
        $this->newsModel->list($bannerDto);
        return [];
    }

    /**
     * banner详细信息
     * @param $id
     * @return array
     */
    public function detail($id): array
    {
        return $this->newsModel->detail($id);
    }
}