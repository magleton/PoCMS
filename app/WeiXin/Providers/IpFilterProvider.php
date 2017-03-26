<?php
/**
 * User: macro
 * Date: 16-10-26
 * Time: 上午11:46
 */

namespace WeiXin\Providers;

use Polymer\Middleware\IpFilterMiddleware;
use Polymer\Utils\Constants;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class IpFilterProvider implements ServiceProviderInterface
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
        $pimple['ip_filter'] = function ($container) {
            return new IpFilterMiddleware($container['application']->config('ip_list'), Constants::ALLOW);
        };
    }
}
