<?php

namespace WeiXin\Models;

use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Events;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use JsonException;
use Polymer\Model\Model;
use Polymer\Utils\FuncUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\AdminDto;
use WeiXin\Dto\OrdersDto;
use WeiXin\Entity\Mapping\Admin;
use WeiXin\Entity\Mapping\Banner;
use WeiXin\Entity\Mapping\Orders;
use WeiXin\Listener\AdminListener;

class OrdersModel extends Model
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
    protected string $table = 'orders';

    /**
     * 添加订单
     * @param AdminDto $orderDto
     * @return int
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws EntityNotFoundException
     */
    public function save(OrdersDto $orderDto): int
    {
        $this->application->addEvent([Events::prePersist => ['className' => AdminListener::class]]);
        $order = $this->make(Orders::class, $orderDto->toArray());
        $this->em->persist($order);
        $this->em->flush();
        return $order->getId();
    }

    /**
     * 更新管理员
     * @param AdminDto $adminDto
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(AdminDto $adminDto)
    {
        $this->application->addEvent([Events::preUpdate => ['className' => AdminListener::class]]);
        $admin = $this->make(Banner::class, $adminDto->toArray(), ['id' => $adminDto->id]);
        $this->em->persist($admin);
        $this->em->flush();
        return $admin->getId();
    }

    /**
     * 管理员列表
     * @param AdminDto $adminDto
     * @return mixed
     */
    public function list(AdminDto $adminDto): array
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
     * 管理员登录
     * @param string $username
     * @param string $password
     * @return string
     * @throws JsonException
     */
    public function login(string $username, string $password): string
    {
        $criteria = ['username' => $username, 'password' => $password];
        $admin = $this->em->getRepository(Admin::class)->findOneBy($criteria);
        if ($admin === null) {
            return '';
        }
        $data = ['userId' => $admin->getId(), 'username' => $admin->getUsername()];
        return authCode(json_encode($data, JSON_THROW_ON_ERROR), $this->tokenSecretKey, 'ENCODE');
    }

    /**
     * 通过token获取管理员信息
     * @param string $token
     * @return array
     * @throws JsonException
     */
    public function getAdminInfo(string $token): array
    {
        $tokenStr = authCode($token, $this->tokenSecretKey);
        if ($tokenStr === '') {
            $tokenStr = '{}';
        }
        return json_decode($tokenStr, true, 512, JSON_THROW_ON_ERROR);
    }
}