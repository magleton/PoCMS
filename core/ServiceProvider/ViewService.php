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

class ViewService implements ServiceProviderInterface
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
        $pimple['view'] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\Views\Twig::class, function () use ($container) {
                $twig_config = \Core\Utils\CoreUtils::getConfig('twig') ? \Core\Utils\CoreUtils::getConfig('twig') : [];
                $view = new \Slim\Views\Twig(TEMPLATE_PATH, $twig_config);
                $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $container['request']->getUri()));
                return $view;
            });
        };
    }
}