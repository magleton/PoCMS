<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-30
 * Time: 下午3:55
 */

namespace Core\ServiceProvider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerNameService implements ServiceProviderInterface
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
        $pimple['serverName'] = function (Container $container) {
            return 'server1';
        };
    }

}