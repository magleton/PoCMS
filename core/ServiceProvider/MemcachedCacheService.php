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

class MemcachedCacheService implements ServiceProviderInterface
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
        $pimple['memcachedCache'] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Memcached::class, function () use ($container) {
                $memcachedConfig = \Core\Utils\CoreUtils::getConfig('cache');
                $memcached = NULL;
                if ($memcachedConfig['memcached']) {
                    $memcached = new \Zend\Cache\Storage\Adapter\Memcached();
                    $server_name = 'server1';
                    $memcached->getOptions()->getResourceManager()->setResource('default', \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::MEMCACHED, $server_name));
                    $memcached->getOptions()->setNamespace($memcachedConfig['memcached'][$server_name]['namespace']);
                }
                return $memcached;
            });
        };
    }
}