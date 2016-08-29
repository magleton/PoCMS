<?php
use Pimple\Container;
use Spiechu\LazyPimple\Factory\LazyLoadingValueHolderFactoryFactory;
use Spiechu\LazyPimple\Factory\LazyServiceFactory;

/**
 * 初始化核心的Container
 *
 * @author <macro_fengye@163.com> macro chen
 */
function initCoreContainer()
{
    $pimpleContainer = new \Slim\Container();
    /*$pimpleContainer['lazy_loading_value_holder_factory_factory'] = function (Container $container) {
        return (new LazyLoadingValueHolderFactoryFactory())
            ->getFactory($container['proxy_manager_cache_target_dir']);
    };
    $pimpleContainer['lazy_service_factory'] = function (Container $container) {
        return new LazyServiceFactory($container['lazy_loading_value_holder_factory_factory']);
    };
    $pimpleContainer['proxy_manager_cache_target_dir'] = function (Container $container) {
        $targetDir = ROOT_PATH . '/proxy_cache_dir';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }
        return $targetDir;
    };*/

    $pimpleContainer['app'] = function (Container $container) {
        return new Slim\App($container);
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\App::class, function () use ($container) {
            return new Slim\App($container);
        });
    };

    /*$pimpleContainer['errorHandler'] = function (Container $container) {
        return function ($request, $response, RuntimeException $exception) use ($container) {
            $container->register(new \Core\ServiceProvider\LoggerService());
            print_r($exception->getTrace());
            $container['logger']->error($exception->__toString());
            if (\Core\Utils\CoreUtils::getConfig('customer')['is_rest']) {
                return $container['response']
                    ->withStatus(500)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson(['code' => 500, 'msg' => '500 status', 'data' => []]);
            } else {
                $body = new \Slim\Http\Body(@fopen(TEMPLATE_PATH . 'error.twig', 'r'));
                return $container['response']
                    ->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->withBody($body);
            };
        };
    };*/
    /*$pimpleContainer['notFoundHandler'] = function (Container $container) {
        return function ($request, $response) use ($container) {
            if (\Core\Utils\CoreUtils::getConfig('customer')['is_rest']) {
                return $container['response']
                    ->withStatus(404)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson(['code' => 1, 'msg' => '404', 'data' => []]);
            } else {
                $body = new \Slim\Http\Body(@fopen(TEMPLATE_PATH . '404.twig', 'r'));
                return $container['response']
                    ->withStatus(404)
                    ->withHeader('Content-Type', 'text/html')
                    ->withBody($body);
            }
        };
    };*/
    /*$pimpleContainer['phpErrorHandler'] = function (Container $container) {
        return $container['errorHandler'];
    };
    $pimpleContainer['notAllowedHandler'] = function (Container $container) {
        return function ($request, $response, $methods) use ($container) {
            return $container['response']
                ->withStatus(405)
                ->withHeader('Allow', implode(', ', $methods))
                ->withHeader('Content-type', 'text/html')
                ->write('Method must be one of: ' . implode(', ', $methods));
        };
    };*/
    /*$pimpleContainer['config'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Noodlehaus\Config::class, function () use ($container) {
            return new \Noodlehaus\Config([APP_PATH . 'Config', ROOT_PATH . '/core/Config']);
        });
    };*/

    /*$pimpleContainer['routerFile'] = function (Container $container) {
        if (!file_exists(APP_PATH . '/Routers/router.lock') || APPLICATION_ENV == "development") {
            if (file_exists(\Core\Utils\CoreUtils::getConfig('customer')['router_cache_file'])) @unlink(\Core\Utils\CoreUtils::getConfig('customer')['router_cache_file']);
            $router_file_contents = '<?php ' . "\n" . '$app = \Core\Utils\CoreUtils::getContainer(\'app\')';
            if (\Core\Utils\CoreUtils::getConfig('customer')['is_rest']) {
                $router_file_contents .= '->add(\Core\Utils\CoreUtils::getContainer(\'jwt\'))->add(\Core\Utils\CoreUtils::getContainer(\'cors\'))';
                if (isset(\Core\Utils\CoreUtils::getConfig('customer')['is_api_rate_limit']) && \Core\Utils\CoreUtils::getConfig('customer')['is_api_rate_limit']) {
                    $router_file_contents .= '->add(\Core\Utils\CoreUtils::getContainer(\'api_rate_limit\'))';
                }
            }
            $router_file_contents .= ';' . "\n";
            foreach (glob(APP_PATH . 'Routers/*_router.php') as $key => $file_name) {
                $contents = file_get_contents($file_name);
                preg_match_all("/app->./", $contents, $matches);
                foreach ($matches[0] as $kk => $vv) {
                    $router_file_contents .= '$' . $vv . "\n";
                }
            }
            file_put_contents(APP_PATH . 'Routers/router.php', $router_file_contents);
            $container['router']->setCacheFile(\Core\Utils\CoreUtils::getConfig('customer')['router_cache_file']);
            touch(APP_PATH . '/Routers/router.lock');
        }
        require_once APP_PATH . 'Routers/router.php';
    };*/

    /*$pimpleContainer['settings'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\Collection::class, function () use ($container) {
            return new Slim\Collection($container['config']['slim']['settings']);
        });
    };*/

    //$pimpleContainer = call_user_func('registerServiceContainer', $pimpleContainer);
    /*if (function_exists('registerCustomerContainer')) {
        $pimpleContainer = call_user_func('registerCustomerContainer', $pimpleContainer);
    }*/
    return $pimpleContainer;
}

/**
 * @param Container $container
 * @return Container
 */
function registerServiceContainer(Container $container)
{
    $container['view'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\Views\Twig::class, function () use ($container) {
            $twig_config = \Core\Utils\CoreUtils::getConfig('twig') ? \Core\Utils\CoreUtils::getConfig('twig') : [];
            $view = new \Slim\Views\Twig(TEMPLATE_PATH, $twig_config);
            $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $container['request']->getUri()));
            return $view;
        });
    };

    $container['csrf'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\Csrf\Guard::class, function () use ($container) {
            $guard = new \Slim\Csrf\Guard();
            $guard->setFailureCallable(function ($request, $response, $next) {
                $request = $request->withAttribute("csrf_status", false);
                return $next($request, $response);
            });
            return $guard;
        }
        );
    };

    /* Monolog */
    $container['logger'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Monolog\Logger::class, function () use ($container) {
            $settings = \Core\Utils\CoreUtils::getConfig('slim')['settings'];
            $logger = new \Monolog\Logger($settings['logger']['name']);
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], $settings['logger']['level']));
            return $logger;
        });
    };
    /*Doctrine2 Memcache Driver*/
    $container["memcacheCacheDriver"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\MemcacheCache::class, function ($server_name = 'server1') use ($container) {
            $memcache = \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::MEMCACHE, $container['server_name']);
            writeLog("debug", [$container['server_name']], APP_PATH . '/error.log');
            $memcacheCacheDriver = new \Doctrine\Common\Cache\MemcacheCache();
            $memcacheCacheDriver->setNamespace("memcacheCacheDriver_namespace");
            $memcacheCacheDriver->setMemcache($memcache);
            return $memcacheCacheDriver;
        });
    };
    /*Doctrine2 Redis Driver*/
    $container["redisCacheDriver"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\RedisCache::class, function () use ($container) {
            $redisCacheDriver = new \Doctrine\Common\Cache\RedisCache();
            $redis = \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::REDIS, 'server1');
            //设置缓存的命名空间
            $redisCacheDriver->setNamespace('redisCacheDriver_namespace');
            $redisCacheDriver->setRedis($redis);
            return $redisCacheDriver;
        });
    };
    /*ZendFrameWork Redis Object*/
    $container["redisCache"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Redis::class, function () use ($container) {
            $redisConfig = \Core\Utils\CoreUtils::getConfig("cache");
            $redis = NULL;
            if ($redisConfig['redis']) {
                $redis = new \Zend\Cache\Storage\Adapter\Redis();
                //设置缓存的命名空间
                $redis->getOptions()->getResourceManager()->setResource('default', \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::REDIS, 'server1'));
                $redis->getOptions()->setNamespace('redisCache_namespace');
            }
            return $redis;
        });
    };
    /*ZendFrameWork Memcache Object*/
    $container["memcacheCache"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Memcache::class, function () use ($container) {
            $memcacheConfig = \Core\Utils\CoreUtils::getConfig("cache");
            $memcache = NULL;
            if ($memcacheConfig['memcache']) {
                $memcache = new \Zend\Cache\Storage\Adapter\Memcache();
                $server_name = 'server1';
                //设置缓存的命名空间
                $memcache->getOptions()->getResourceManager()->setResource('default', \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::MEMCACHE, $server_name));
                $memcache->getOptions()->setNamespace($memcacheConfig['memcache'][$server_name]['namespace']);
            }
            return $memcache;
        });
    };
    /*ZendFrameWork Memcached Object*/
    $container['memcachedCache'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Memcached::class, function () use ($container) {
            $memcachedConfig = \Core\Utils\CoreUtils::getConfig('cache');
            $memcached = NULL;
            if ($memcachedConfig['memcached']) {
                $memcached = new \Zend\Cache\Storage\Adapter\Memcached();
                $server_name = 'server1';
                $memcached->getOptions()->getResourceManager()->setResource('default', \Core\Utils\CoreUtils::getCacheInstance(\Core\Utils\CoreUtils::MEMCACHED, $server_name));
                $memcached->getOptions()->setNamespace($memcachedConfig['memcached'][$server_name]['namespace']);
            }
            return $memcached;
        });
    };
    /*ZendFrameWork FileSystemCache*/
    $container["fileSystemCache"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Filesystem::class, function () use ($container) {
            $fileSystem = new \Zend\Cache\Storage\Adapter\Filesystem(array(
                "cache_dir" => CACHE_DIR . "/cache"
            ));
            return $fileSystem;
        });
    };
    /*SessionManager Object*/
    $container['sessionManager'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Session\SessionManager::class, function () use ($container) {
            $config = new \Zend\Session\Config\SessionConfig();
            $config->setOptions(\Core\Utils\CoreUtils::getConfig("session")['manager']);
            $sessionManager = new \Zend\Session\SessionManager($config);
            $sessionManager->setStorage(new \Zend\Session\Storage\SessionArrayStorage());
            $sessionManager->start();
            return $sessionManager;
        });
    };
    /*SessionManager Container Object*/
    $container["sessionContainer"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Session\Container::class, function () use ($container) {
            $sessionManager = \Core\Utils\CoreUtils::getContainer("sessionManager");
            \Zend\Session\Container::setDefaultManager($sessionManager);
            $container = new \Zend\Session\Container(\Core\Utils\CoreUtils::getConfig("session")['container']['namespace']);
            return $container;
        });
    };

    /*Event Manager Object*/
    $container["zendEventManager"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\EventManager\Event::class, function () {
            return new \Zend\EventManager\EventManager();
        });
    };

    /*Doctrine Event Manager Object*/
    $container["doctrineEventManager"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\EventManager::class, function () {
            return new \Doctrine\Common\EventManager();
        });
    };

    /*Zend ServiceManager*/
    $container['serviceManager'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\ServiceManager\ServiceManager::class, function () {
            $serviceManager = new \Zend\ServiceManager\ServiceManager();
            return $serviceManager;
        });
    };

    $container['apcu'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\ApcuCache::class, function () {
            return new \Doctrine\Common\Cache\ApcuCache();
        });
    };
    $container['xcache'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\XcacheCache::class, function () {
            return new \Doctrine\Common\Cache\XcacheCache();
        });
    };
    $container['flash'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Slim\Flash\Messages::class, function () use ($container) {
            $container['sessionContainer']->author = "MacroChen";
            return new \Slim\Flash\Messages();
        });
    };

    return $container;
}
