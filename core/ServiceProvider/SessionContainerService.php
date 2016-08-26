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

class SessionContainerService implements ServiceProviderInterface
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
        $pimple["sessionContainer"] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Session\Container::class, function () use ($container) {
                $sessionManager = \Core\Utils\CoreUtils::getContainer("sessionManager");
                \Zend\Session\Container::setDefaultManager($sessionManager);
                $container = new \Zend\Session\Container(\Core\Utils\CoreUtils::getConfig("session")['container']['namespace']);
                return $container;
            });
        };
    }
}