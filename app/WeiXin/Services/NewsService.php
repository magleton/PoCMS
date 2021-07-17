<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use WeiXin\Dto\NewsDto;
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
        $this->newsModel->save($newsDto);
        return 19;
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
        $this->newsModel->update($newsDto);
        return 19;
    }

    /**
     * banner列表
     * @param NewsDto $newsDto
     * @return array
     */
    public function list(NewsDto $newsDto): array
    {
        $this->newsModel->list($newsDto);
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