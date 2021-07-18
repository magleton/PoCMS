<?php

namespace WeiXin\Models;

use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Polymer\Model\Model;
use Polymer\Tests\Listener\BaseListener;
use Polymer\Utils\FuncUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\BannerDto;
use WeiXin\Dto\NewsDto;
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
     * @param NewsDto $newsDto
     * @return int
     * @throws ORMException
     */
    public function save(NewsDto $newsDto): int
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
     * @param NewsDto $newsDto
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws EntityNotFoundException
     */
    public function update(NewsDto $newsDto)
    {
        $this->application->addEvent([Events::preUpdate => ['class_name' => BaseListener::class]]);
        $banner = $this->make(News::class, $newsDto->toArray(), ['id' => $newsDto->id]);
        $this->em->persist($banner);
        $this->em->flush();
        return $banner->getId();
    }

    /**
     * 列表Banner
     * @param BannerDto $bannerDto
     * @return mixed
     */
    public function list(BannerDto $bannerDto): array
    {
        $entityRepository = $this->em->getRepository(News::class);
        return $entityRepository->findBy(['filename' => 'aaaaa'], ['id' => 'desc']);
    }

    /**
     * 获取详情
     * @param $id
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     * @throws ExceptionInterface
     */
    public function detail($id): array
    {
        $this->application->addEvent([Events::postLoad => ['class_name' => NewsListener::class]]);
        $banner = $this->em->getRepository(News::class)->find($id);
        return FuncUtils::entityToArray($banner);
    }
}