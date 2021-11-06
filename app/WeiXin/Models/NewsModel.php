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
use WeiXin\Dto\CategoryDto;
use WeiXin\Dto\SearchDto;
use WeiXin\Entity\Mapping\News;
use WeiXin\Listener\NewsListener;

class NewsModel extends Model
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
    protected string $table = 'news';

    /**
     * @Inject
     * @var CategoryModel
     */
    protected CategoryModel $categoryModel;

    /**
     * 添加banner
     * @param CategoryDto $newsDto
     * @return int
     * @throws ORMException
     */
    public function save(CategoryDto $newsDto): int
    {
        $this->application->addEvent([Events::prePersist => ['class_name' => NewsListener::class]]);
        $news = $this->make(News::class, $newsDto->toArray());
        $news->setCategory($this->categoryModel->getCategoryById($newsDto->categoryId));
        $this->em->persist($news);
        $this->em->flush();
        return $news->getId();
    }

    /**
     * 更新Banner
     * @param CategoryDto $newsDto
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws EntityNotFoundException
     * @throws Exception
     */
    public function update(CategoryDto $newsDto)
    {
        $this->application->addEvent([Events::preUpdate => ['class_name' => NewsListener::class]]);
        $news = $this->make(News::class, $newsDto->toArray(), ['id' => $newsDto->id]);
        $this->em->persist($news);
        $this->em->flush();
        return $news->getId();
    }

    /**
     * 新闻列表
     * @param SearchDto $searchDto
     * @return mixed
     * @throws Exception|ExceptionInterface
     */
    public function list(SearchDto $searchDto): array
    {
        $pageSize = $searchDto->pageSize;
        $page = $searchDto->page;
        $offset = ($page - 1) * $searchDto->pageSize;
        $entityRepository = $this->em->getRepository(News::class);
        $count = $entityRepository->count($searchDto->searchCondition);
        $list = $entityRepository->findBy($searchDto->searchCondition, ['id' => 'desc'], $pageSize, $offset);
        return $this->page($list, $count, $searchDto);
    }

    /**
     * 获取详情
     * @param $id
     * @return array
     * @throws DependencyException
     * @throws ExceptionInterface
     * @throws NotFoundException
     */
    public function detail($id): array
    {
        $obj = $this->em->getRepository(News::class)->findOneBy(['id' => $id]);
        return FuncUtils::entityToArray($obj);
    }
}