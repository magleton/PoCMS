<?php

namespace WeiXin\Dao;

use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Polymer\Dao\BaseDao;
use Polymer\Utils\FuncUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\Req\BannerReqDto;
use WeiXin\Entity\Mapping\Banner;
use WeiXin\Listener\BannerListener;

class BannerDao extends BaseDao
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
     * @param BannerReqDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(BannerReqDto $bannerDto): int
    {
        $this->application->addEvent([Events::prePersist => ['className' => BannerListener::class]]);
        $banner = $this->make(Banner::class, $bannerDto->toArray());
        $this->em->persist($banner);
        $this->em->flush();
        return $banner->getId();
    }

    /**
     * 更新Banner
     * @param BannerReqDto $bannerDto
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(BannerReqDto $bannerDto)
    {
        $this->application->addEvent([Events::preUpdate => ['className' => BannerListener::class]]);
        $banner = $this->make(Banner::class, $bannerDto->toArray(), ['id' => $bannerDto->id]);
        $this->em->persist($banner);
        $this->em->flush();
        return $banner->getId();
    }

    /**
     * 列表Banner
     * @param BannerReqDto $bannerDto
     * @return mixed
     */
    public function list(BannerReqDto $bannerDto): array
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
}