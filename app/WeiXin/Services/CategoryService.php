<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
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
        $list = $this->categoryModel->list($searchDto);
        return $this->getTree($list);
    }

    /**
     * 递归实现无限极分类
     * @param array $list
     * @return array $tree
     */
    private function getTree(array $list): array
    {
        $items = array();
        foreach ($list as $value) {
            $items[$value['id']] = $value;
        }
        $tree = [];
        foreach ($items as $key => $item) {
            if (isset($items[$item['parentId']])) {
                $items[$key]['level'] = count(explode(',', $items[$key]['path']));
                $items[$item['parentId']]['children'][] = &$items[$key];
            } else {
                $items[$key]['level'] = count(explode(',', $items[$key]['path']));
                $tree[] = &$items[$key];
            }
        }
        return $tree;
    }

    /**
     * banner详细信息
     * @param $id
     * @return array
     * @throws Exception|ExceptionInterface
     */
    public function detail($id): array
    {
        return $this->categoryModel->detail($id);
    }
}