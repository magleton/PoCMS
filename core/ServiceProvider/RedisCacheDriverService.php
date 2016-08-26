<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-26
 * Time: 上午9:24
 */
namespace Core\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RedisCacheDriverService implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple["redisCacheDriver"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\RedisCache::class, function () use ($container) {
                $redisCacheDriver = new \Doctrine\Common\Cache\RedisCache();
                $redis = \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::REDIS, 'server1');
                //设置缓存的命名空间
                $redisCacheDriver->setNamespace('redisCacheDriver_namespace');
                $redisCacheDriver->setRedis($redis);
                return $redisCacheDriver;
            });
        };
    }
}