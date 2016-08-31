<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-29
 * Time: 上午7:48
 */

namespace Core\ServiceProvider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InitAppService implements ServiceProviderInterface
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
        $pimple['app'] = function (Container $container) {
            $container->register(new ErrorHandler());
            $container->register(new NotFoundHandler());
            $container->register(new PhpErrorHandler());
            $container->register(new NotAllowedHandler());
            $container->register(new LazyService());
            return new \Slim\App($container);
        };
    }

}