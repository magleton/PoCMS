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
use Core\Utils\CoreUtils;
use Zend\Cache\Storage\Adapter\Redis;

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
            return $container['lazy_service_factory']->getLazyServiceDefinition(Redis::class, function () use ($container) {
                $redisConfig = CoreUtils::getConfig("cache");
                $redis = NULL;
                if ($redisConfig['redis']) {
                    $server_name = 'server1';
                    $namespace = 'redisCacheNamespace';
                    if (CoreUtils::getContainer('server_name')) {
                        $server_name = CoreUtils::getContainer('server_name');
                    }
                    if (CoreUtils::getContainer('namespace')) {
                        $namespace = CoreUtils::getContainer('namespace');
                    }
                    $redis = new Redis();
                    //设置缓存的命名空间
                    $redis->getOptions()->getResourceManager()->setResource('default', CoreUtils::getCacheInstance(CoreUtils::REDIS, $server_name));
                    $redis->getOptions()->setNamespace($namespace);
                }
                return $redis;
            });
        };
    }
}