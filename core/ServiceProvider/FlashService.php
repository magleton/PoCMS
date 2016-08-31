<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-26
 * Time: 上午9:24
 */

namespace Core\ServiceProvider;


use Core\Utils\CoreUtils;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class FlashService implements ServiceProviderInterface
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
        $pimple['flash'] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\Flash\Messages::class, function () use ($container) {
                CoreUtils::getContainer('sessionContainer')->author = "MacroChen";
                return new \Slim\Flash\Messages();
            });
        };
    }
}