<?php

namespace WeiXin\Listener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use JsonException;
use Polymer\Tests\Listener\BaseListener;

class NewsListener extends BaseListener
{
    /**
     * @var array
     */
    private array $params;

    /**
     * 保存之前处理数据
     *
     * @param LifecycleEventArgs $args
     * @throws JsonException
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $args->getObject()->setCreatedAt(time());
    }

    /**
     * 更新数据之前处理数据
     *
     * @param LifecycleEventArgs $args
     * @throws JsonException
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $args->getObject()->setUpdatedAt(time());
    }

    /**
     * 将ext字段转换为数组
     *
     * @throws JsonException
     */
    public function postLoad(LifecycleEventArgs $args): void
    {
        $args->getObject()->setExt(json_decode($args->getObject()->getExt(), true, 512, JSON_THROW_ON_ERROR));
    }
}