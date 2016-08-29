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
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\MemcacheCache::class, function ($server_name = 'server1') use ($container) {
                $memcache = \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::MEMCACHE, $container['server_name']);
                writeLog("debug", [$container['server_name']], APP_PATH . '/error.log');
                $memcacheCacheDriver = new \Doctrine\Common\Cache\MemcacheCache();
                $memcacheCacheDriver->setNamespace("memcacheCacheDriver_namespace");
                $memcacheCacheDriver->setMemcache($memcache);
                return $memcacheCacheDriver;
            });
        };
    }
}