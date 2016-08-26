<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-26
 * Time: 下午4:27
 */

namespace Core\ServiceProvider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Spiechu\LazyPimple\Factory\LazyLoadingValueHolderFactoryFactory;
use Spiechu\LazyPimple\Factory\LazyServiceFactory;


class LazyService implements ServiceProviderInterface
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
        $pimple['lazy_loading_value_holder_factory_factory'] = function ($container) {
            return (new LazyLoadingValueHolderFactoryFactory())
                ->getFactory($container['proxy_manager_cache_target_dir']);
        };
        $pimple['lazy_service_factory'] = function ($container) {
            return new LazyServiceFactory($container['lazy_loading_value_holder_factory_factory']);
        };
        $pimple['proxy_manager_cache_target_dir'] = function ($container) {
            $targetDir = ROOT_PATH . '/proxy_cache_dir';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0775, true);
            }
            return $targetDir;
        };
    }

}