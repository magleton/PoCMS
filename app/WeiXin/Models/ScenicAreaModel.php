<?php


namespace WeiXin\Models;


use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Polymer\Model\Model;
use Polymer\Utils\FuncUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\Req\ScenicAreaDto;
use WeiXin\Entity\Mapping\ScenicArea;
use WeiXin\Listener\AdminListener;

class ScenicAreaModel extends Model
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
    protected string $table = 'scenic_area';

    /**
     * 添加景区
     * @param ScenicAreaDto $scenicAreaDto
     * @return int
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(ScenicAreaDto $scenicAreaDto): int
    {
        $this->application->addEvent([Events::prePersist => ['className' => AdminListener::class]]);
        $scenicArea = $this->make(ScenicArea::class, $scenicAreaDto->toArray());
        $this->em->persist($scenicArea);
        $this->em->flush();
        return $scenicArea->getId();
    }

    /**
     * 更新景区
     * @param ScenicAreaDto $scenicAreaDto
     * @return mixed
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(ScenicAreaDto $scenicAreaDto)
    {
        $this->application->addEvent([Events::preUpdate => ['className' => AdminListener::class]]);
        $scenicArea = $this->make(ScenicArea::class, $scenicAreaDto->toArray(), ['id' => $scenicAreaDto->id]);
        $this->em->persist($scenicArea);
        $this->em->flush();
        return $scenicArea->getId();
    }

    /**
     * 景区列表
     * @param ScenicAreaDto $scenicAreaDto
     * @return mixed
     */
    public function list(ScenicAreaDto $scenicAreaDto): array
    {
        $entityRepository = $this->em->getRepository(ScenicArea::class);
        return $entityRepository->findBy(['filename' => 'aaaaa'], ['id' => 'desc']);
    }

    /**
     * 景区详细信息
     * @param $id
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     * @throws ExceptionInterface
     */
    public function detail($id): array
    {
        $banner = $this->em->getRepository(ScenicArea::class)->find($id);
        return FuncUtils::entityToArray($banner);
    }
}