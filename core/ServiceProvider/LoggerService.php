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

class LoggerService implements ServiceProviderInterface
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
        $pimple['logger'] = function (Container $container) {
            return $container['lazy_service_factory']->getLazyServiceDefinition(\Monolog\Logger::class, function () use ($container) {
                $settings = \Core\Utils\CoreUtils::getConfig('slim')['settings'];
                $logger = new \Monolog\Logger($settings['logger']['name']);
                $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
                $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], $settings['logger']['level']));
                return $logger;
            });
        };
    }
}