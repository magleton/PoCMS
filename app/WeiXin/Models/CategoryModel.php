<?php

namespace WeiXin\Models;

use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Polymer\Model\Model;
use Polymer\Utils\FuncUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\SearchDto;
use WeiXin\Entity\Mapping\Banner;
use WeiXin\Entity\Mapping\Category;
use WeiXin\Listener\BannerListener;

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
     * @param SearchDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(SearchDto $bannerDto): int
    {
        $this->application->addEvent([Events::prePersist => ['class_name' => BannerListener::class]]);
        $banner = $this->make(CategoryModel::class, $bannerDto->toArray());
        $this->em->persist($banner);
        $this->em->flush();
        return $banner->getId();
    }

    /**
     * 更新Banner
     * @param SearchDto $bannerDto
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(SearchDto $bannerDto)
    {
        $this->application->addEvent([Events::preUpdate => ['class_name' => BannerListener::class]]);
        $banner = $this->make(Banner::class, $bannerDto->toArray(), ['id' => $bannerDto->id]);
        $this->em->persist($banner);
        $this->em->flush();
        return $banner->getId();
    }

    /**
     * 列表Banner
     * @param SearchDto $bannerDto
     * @return mixed
     */
    public function list(SearchDto $bannerDto): array
    {
        $entityRepository = $this->em->getRepository(Banner::class);
        return $entityRepository->findBy(['filename' => 'aaaaa'], ['id' => 'desc']);
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
        $banner = $this->em->getRepository(Banner::class)->find($id);
        return FuncUtils::entityToArray($banner);
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