<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/1
 * Time: 19:40
 */

namespace Core\ServiceProvider;


use Core\Utils\CoreUtils;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RedisService implements ServiceProviderInterface
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
        $pimple['redis'] = function (Container $container) {
            $cacheConfig = CoreUtils::getConfig('cache');
            $server_name = 'server1';
            $type = 'redis';
            if (CoreUtils::getContainer('server_name')) {
                $server_name = CoreUtils::getContainer('server_name');
            }
            $redis = new \Redis();
            $redis->connect($cacheConfig[$type][$server_name]['server']['host'], $cacheConfig[$type][$server_name]['server']['port'], $cacheConfig[$type][$server_name]['server']['timeout']);
            return $redis;
        };
    }

}