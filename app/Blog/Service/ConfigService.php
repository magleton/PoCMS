<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/26
 * Time: 22:38
 */

namespace Blog\Service;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigService implements ServiceProviderInterface
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
        $pimple['config'] = function ($container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Noodlehaus\Config::class, function () use ($container) {
                return new \Noodlehaus\Config([APP_PATH . 'Config' , APP_PATH . 'Config/Test', ROOT_PATH . '/core/Config']);
            });
        };
    }

}