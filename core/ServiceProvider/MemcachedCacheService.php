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
                $memcachedConfig = CoreUtils::getConfig('cache');
                $memcached = NULL;
                if ($memcachedConfig['memcached']) {
                    $server_name = 'server1';
                    if (CoreUtils::getContainer('server_name')) {
                        $server_name = CoreUtils::getContainer('server_name');
                    }
                    $memcached = new \Zend\Cache\Storage\Adapter\Memcached();
                    $memcached->getOptions()->getResourceManager()->setResource('default', CoreUtils::getCacheInstance(CoreUtils::MEMCACHED, $server_name));
                    $memcached->getOptions()->setNamespace($memcachedConfig['memcached'][$server_name]['namespace']);
                }
                return $memcached;
            });
        };
    }
}