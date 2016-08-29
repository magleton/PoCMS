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

class ZendEventManagerService implements ServiceProviderInterface
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
        $pimple["zendEventManager"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\EventManager\Event::class, function () {
                return new \Zend\EventManager\EventManager();
            });
        };
    }
}