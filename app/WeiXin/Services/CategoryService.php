<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use WeiXin\Dto\CategoryDto;
use WeiXin\Dto\SearchDto;
use WeiXin\Models\CategoryModel;

/**
 * 分类服务
 * Interface CategoryService
 * @package WeiXin\Services
 */
class CategoryService
{
    /**
     * @Inject
     * @var CategoryModel
     */
    private CategoryModel $categoryModel;

    /**
     * 新增banner
     * @param CategoryDto $categoryDto
     * @return int
     * @throws ORMException
     */
    public function save(CategoryDto $categoryDto): int
    {
        return $this->categoryModel->save($categoryDto);
    }

    /**
     * 修改banner
     * @param CategoryDto $newsDto
     * @return int
     * @throws ORMException
     * @throws EntityNotFoundException
     * @throws OptimisticLockException
     */
    public function update(CategoryDto $newsDto): int
    {
        return $this->categoryModel->update($newsDto);
    }

    /**
     * banner列表
     * @param SearchDto $searchDto
     * @return array
     */
    public function list(SearchDto $searchDto): array
    {
        return $this->categoryModel->list($searchDto);
    }

    /**
     * banner详细信息
     * @param $id
     * @return array
     */
    public function detail($id): array
    {
        return $this->categoryModel->detail($id);
    }
}