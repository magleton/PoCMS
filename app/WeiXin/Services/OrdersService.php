<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;
use Exception;
use Polymer\Service\Service;
use WeiXin\Dto\OrdersDto;
use WeiXin\Models\OrdersModel;

/**
 * @Injectable
 * Class OrderService
 * @package WeiXin\Services
 */
class OrdersService extends Service
{
    /**
     * @Inject
     * @var OrdersModel
     */
    private OrdersModel $orderModel;

    /**
     * 管理员登录
     * @param OrdersDto $orderDto
     * @return string
     * @throws Exception
     */
    public function save(OrdersDto $orderDto): string
    {
        return $this->orderModel->save($orderDto);
    }
}