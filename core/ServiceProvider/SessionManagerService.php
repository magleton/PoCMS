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

class SessionManagerService implements ServiceProviderInterface
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
        $pimple['sessionManager'] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Session\SessionManager::class, function () use ($container) {
                $config = new \Zend\Session\Config\SessionConfig();
                $config->setOptions(\Core\Utils\CoreUtils::getConfig("session")['manager']);
                $sessionManager = new \Zend\Session\SessionManager($config);
                $sessionManager->setStorage(new \Zend\Session\Storage\SessionArrayStorage());
                $sessionManager->start();
                return $sessionManager;
            });
        };
    }
}