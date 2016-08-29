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

class MemcacheCacheService implements ServiceProviderInterface
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
        $pimple["memcacheCache"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Memcache::class, function () use ($container) {
                $memcacheConfig = \Core\Utils\CoreUtils::getConfig("cache");
                $memcache = NULL;
                if ($memcacheConfig['memcache']) {
                    $memcache = new \Zend\Cache\Storage\Adapter\Memcache();
                    $server_name = 'server1';
                    //设置缓存的命名空间
                    $memcache->getOptions()->getResourceManager()->setResource('default', \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::MEMCACHE, $server_name));
                    $memcache->getOptions()->setNamespace($memcacheConfig['memcache'][$server_name]['namespace']);
                }
                return $memcache;
            });
        };
    }
}