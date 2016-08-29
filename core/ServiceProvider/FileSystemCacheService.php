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

class FileSystemCacheService implements ServiceProviderInterface
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
        $pimple["fileSystemCache"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Filesystem::class, function () use ($container) {
                $fileSystem = new \Zend\Cache\Storage\Adapter\Filesystem(array(
                    "cache_dir" => CACHE_DIR . "/cache"
                ));
                return $fileSystem;
            });
        };
    }
}