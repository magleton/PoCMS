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
use Zend\Cache\Storage\Adapter\Memcached;

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
            return $container['lazy_service_factory']->getLazyServiceDefinition(Memcached::class, function () use ($container) {
                $memcachedConfig = CoreUtils::getConfig('cache');
                $memcached = NULL;
                if ($memcachedConfig['memcached']) {
                    $server_name = 'server1';
                    $namespace = $memcachedConfig['memcached'][$server_name]['namespace'];
                    if (CoreUtils::getContainer('server_name')) {
                        $server_name = CoreUtils::getContainer('server_name');
                    }
                    if (CoreUtils::getContainer('namespace')) {
                        $namespace = CoreUtils::getContainer('namespace');
                    }
                    $memcached = new Memcached();
                    $memcached->getOptions()->getResourceManager()->setResource('default', CoreUtils::getCacheInstance(CoreUtils::MEMCACHED, $server_name));
                    $memcached->getOptions()->setNamespace($namespace);
                }
                return $memcached;
            });
        };
    }
}