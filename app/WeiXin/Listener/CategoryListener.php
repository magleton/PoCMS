<?php

namespace WeiXin\Listener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use JsonException;
use WeiXin\Entity\Mapping\Category;

class CategoryListener
{
    /**
     * @var array
     */
    private array $params;

    /**
     * 保存之前处理数据
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $parentId = $args->getObject()->getParentId();
        if ($parentId === 0) {
            $args->getObject()->setPath($parentId);
        } else if ($parentId > 0) {
            $aprent = $args->getObjectManager()->getRepository(Category::class)->find($parentId);
            $args->getObject()->setPath($aprent->getPath() . ',' . $parentId);
        }
        $args->getObject()->setCreatedAt(time());
    }

    /**
     * 更新数据之前处理数据
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $parentId = $args->getObject()->getParentId();
        if ($parentId === 0) {
            $args->getObject()->setPath($parentId);
        } else if ($parentId > 0) {
            $parent = $args->getObjectManager()->getRepository(Category::class)->find($parentId);
            $args->getObject()->setPath($parent->getPath() . ',' . $parentId);
        }
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