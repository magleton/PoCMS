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
                $memcacheConfig = CoreUtils::getConfig("cache");
                $memcache = NULL;
                if ($memcacheConfig['memcache']) {
                    $memcache = new \Zend\Cache\Storage\Adapter\Memcache();
                    $server_name = 'server1';
                    if (CoreUtils::getContainer('server_name')) {
                        $server_name = CoreUtils::getContainer('server_name');
                    }
                    //设置缓存的命名空间
                    $memcache->getOptions()->getResourceManager()->setResource('default', CoreUtils::getCacheInstance(CoreUtils::MEMCACHE, $server_name));
                    $memcache->getOptions()->setNamespace($memcacheConfig['memcache'][$server_name]['namespace']);
                }
                return $memcache;
            });
        };
    }
}