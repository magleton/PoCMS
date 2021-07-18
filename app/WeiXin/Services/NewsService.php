<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use WeiXin\Dto\NewsDto;
use WeiXin\Dto\SearchDto;
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
     * @param NewsDto $newsDto
     * @return int
     * @throws ORMException
     */
    public function save(NewsDto $newsDto): int
    {
        return $this->newsModel->save($newsDto);
    }

    /**
     * 修改banner
     * @param NewsDto $newsDto
     * @return int
     * @throws ORMException
     * @throws EntityNotFoundException
     * @throws OptimisticLockException
     */
    public function update(NewsDto $newsDto): int
    {
        return $this->newsModel->update($newsDto);
    }

    /**
     * banner列表
     * @param SearchDto $searchDto
     * @return array
     */
    public function list(SearchDto $searchDto): array
    {
        return $this->newsModel->list($searchDto);
    }

    /**
     * banner详细信息
     * @param $id
     * @return array
     */
    public function detail($id): array
    {
        $news = $this->newsModel->detail($id);
        return $news;
    }
}