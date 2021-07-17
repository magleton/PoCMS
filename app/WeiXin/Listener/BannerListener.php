<?php

namespace WeiXin\Listener;

use Doctrine\Persistence\Event\LifecycleEventArgs;

class BannerListener
{
    /**
     * @var array
     */
    private array $params;

    /**
     * TestListener constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * 保存之前处理数据
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $args->getObject()->setCreatedAt(time());
    }

    /**
     * 更新数据之前处理数据
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $args->getObject()->setUpdatedAt(time());
    }
}