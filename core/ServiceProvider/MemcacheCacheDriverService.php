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
            $namespace = 'memcacheCacheDriver';
            if (app()->getContainer('namespace')) {
                $namespace = app()->getContainer('namespace');
            }
            $memcacheCacheDriver = new MemcacheCache();
            $memcacheCacheDriver->setNamespace($namespace);
            $memcacheCacheDriver->setMemcache(app()->getContainer('memcache'));
            return $memcacheCacheDriver;
        };
    }
}