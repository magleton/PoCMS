<?php

namespace WeiXin\Models;

use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Polymer\Model\Model;
use Polymer\Utils\FuncUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\Req\CategoryDto;
use WeiXin\Dto\Req\SearchDto;
use WeiXin\Entity\Mapping\Category;
use WeiXin\Listener\CategoryListener;

class CategoryModel extends Model
{
    /**
     * 数据库配置
     * @var string
     */
    protected string $schema = 'db1';

    /**
     * 数据库表名
     * @var string
     */
    protected string $table = 'category';

    /**
     * 添加banner
     * @param CategoryDto $categoryDto
     * @return int
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws EntityNotFoundException
     * @throws Exception
     */
    public function save(CategoryDto $categoryDto): int
    {
        $this->application->addEvent([Events::prePersist => ['className' => CategoryListener::class]]);
        $category = $this->make(Category::class, $categoryDto->toArray());
        $this->em->persist($category);
        $this->em->flush();
        return $category->getId();
    }

    /**
     * 更新Banner
     * @param CategoryDto $categoryDto
     * @return mixed
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function update(CategoryDto $categoryDto)
    {
        $this->application->addEvent([Events::preUpdate => ['className' => CategoryListener::class]]);
        $category = $this->make(Category::class, $categoryDto->toArray(), ['id' => $categoryDto->id]);
        $this->em->persist($category);
        $this->em->flush();
        return $category->getId();
    }

    /**
     * Banner列表
     * @param SearchDto $searchDto
     * @return mixed
     * @throws DependencyException
     * @throws ExceptionInterface
     * @throws NotFoundException
     */
    public function list(SearchDto $searchDto): array
    {
        $entityRepository = $this->em->getRepository(Category::class);
        $list = $entityRepository->findBy($searchDto->searchCondition, ['id' => 'desc']);
        $retData = [];
        foreach ($list as $value) {
            $retData[] = FuncUtils::entityToArray($value);
        }
        return $retData;
    }

    /**
     * 详细信息
     * @param $id
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     * @throws ExceptionInterface
     */
    public function detail($id): array
    {
        $category = $this->em->getRepository(Category::class)->find($id);
        return FuncUtils::entityToArray($category);
    }

    /**
     * 通过分类ID获取分类对象
     * @param int $id
     * @return Category
     */
    public function getCategoryById(int $id): Category
    {
        return $this->em->getRepository(Category::class)->find($id);
    }
}