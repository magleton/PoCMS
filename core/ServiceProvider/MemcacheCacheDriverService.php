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
use Doctrine\Common\Cache\MemcacheCache;

class MemcacheCacheDriverService implements ServiceProviderInterface
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
        $pimple["memcacheCacheDriver"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(MemcacheCache::class, function ($server_name = 'server1') use ($container) {
                $memcachedConfig = CoreUtils::getConfig('cache');
                $server_name = 'server1';
                $namespace = $memcachedConfig['memcached'][$server_name]['namespace'];
                if (CoreUtils::getContainer('server_name')) {
                    $server_name = CoreUtils::getContainer('server_name');
                }
                if (CoreUtils::getContainer('namespace')) {
                    $namespace = CoreUtils::getContainer('namespace');
                }
                $memcache = CoreUtils::getCacheInstance(CoreUtils::MEMCACHE, $server_name);
                $memcacheCacheDriver = new MemcacheCache();
                $memcacheCacheDriver->setNamespace($namespace);
                $memcacheCacheDriver->setMemcache($memcache);
                return $memcacheCacheDriver;
            });
        };
    }
}