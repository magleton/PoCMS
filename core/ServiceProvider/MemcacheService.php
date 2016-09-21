<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/1
 * Time: 19:45
 */

namespace Core\ServiceProvider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Core\Utils\CoreUtils;

class MemcacheService implements ServiceProviderInterface
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
        $pimple['memcache'] = function (Container $container) {
            $cacheConfig = CoreUtils::getConfig('cache');
            $server_name = 'server1';
            $type = 'memcache';
            if (CoreUtils::getContainer('server_name')) {
                $server_name = CoreUtils::getContainer('server_name');
            }
            $memcache = new \Memcache();
            foreach ($cacheConfig[$type][$server_name]['servers'] as $key => $server) {
                $memcache->addServer($server['host'], $server['port'], $server['timeout']);
            }
            return $memcache;
        };
    }

}