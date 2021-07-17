<?php

namespace WeiXin\Models;

use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Polymer\Model\Model;
use WeiXin\Dto\BannerDto;
use WeiXin\Entity\Mapping\Banner;
use WeiXin\Listener\BannerListener;

class BannerModel extends Model
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
    protected string $table = 'banner';

    /**
     * 添加banner
     * @param BannerDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(BannerDto $bannerDto): int
    {
        $this->application->addEvent([Events::prePersist => ['class_name' => BannerListener::class]]);
        $banner = $this->make($bannerDto->toArray());
        $this->em->persist($banner);
        $this->em->flush();
        return $banner->getId();
    }

    /**
     * 更新Banner
     * @param BannerDto $bannerDto
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(BannerDto $bannerDto)
    {
        $this->application->addEvent([Events::preUpdate => ['class_name' => BannerListener::class]]);
        $banner = $this->make(Banner::class, $bannerDto->toArray(), ['id' => $bannerDto->id]);
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
        $entityRepository = $this->em->getRepository(Banner::class);
        return $entityRepository->findBy(['filename' => 'aaaaa'], ['id' => 'desc']);
    }
}