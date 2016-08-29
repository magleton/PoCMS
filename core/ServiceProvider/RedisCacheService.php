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

class RedisCacheService implements ServiceProviderInterface
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
        $pimple["redisCache"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Redis::class, function () use ($container) {
                $redisConfig = \Core\Utils\CoreUtils::getConfig("cache");
                $redis = NULL;
                if ($redisConfig['redis']) {
                    $redis = new \Zend\Cache\Storage\Adapter\Redis();
                    //设置缓存的命名空间
                    $redis->getOptions()->getResourceManager()->setResource('default', \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::REDIS, 'server1'));
                    $redis->getOptions()->setNamespace('redisCache_namespace');
                }
                return $redis;
            });
        };
    }
}