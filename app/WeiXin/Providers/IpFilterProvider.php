<?php
/**
 * User: macro
 * Date: 16-10-26
 * Time: 上午11:46
 */

namespace WeiXin\Providers;

use DI\Container;
use Polymer\Middleware\IpFilterMiddleware;
use Polymer\Utils\Constants;

class IpFilterProvider
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $diContainer A container instance
     */
    public function register(Container $diContainer): void
    {
        $diContainer->set(__CLASS__, static function () use ($diContainer) {
            return new IpFilterMiddleware($diContainer->get('application')->config('ip_list'), Constants::ALLOW);
        });
    }
}
