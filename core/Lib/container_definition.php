<?php
use Pimple\Container;
use Spiechu\LazyPimple\DependencyInjection\ExtendServiceDefinition;
use Spiechu\LazyPimple\DependencyInjection\LazyEventSubscriberServiceProvider;
use Spiechu\LazyPimple\DependencyInjection\MultiServiceAwareExtender;
use Spiechu\LazyPimple\Factory\LazyLoadingValueHolderFactoryFactory;
use Spiechu\LazyPimple\Factory\LazyServiceFactory;
use Spiechu\LazyPimple\FirstSubscriber;
use Spiechu\LazyPimple\Service\AnotherService;
use Spiechu\LazyPimple\Service\AwesomeService;
use Spiechu\LazyPimple\Service\EventEmittingService;
use Spiechu\LazyPimple\ServiceToExtend\AwesomeServiceAwareClass;
use Spiechu\LazyPimple\ServiceToExtend\AwesomeServiceAwareInterface;
use Spiechu\LazyPimple\ServiceToExtend\BothInterfacesAwareClass;
use Spiechu\LazyPimple\ServiceToExtend\EventDispatcherAwareInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * 初始化核心的Container
 * @author <macro_fengye@163.com> macro chen
 */
function initCoreContainer()
{
    $pimpleContainer = new \Slim\Container();
    $pimpleContainer['lazy_loading_value_holder_factory_factory'] = function (Container $container) {
        return (new LazyLoadingValueHolderFactoryFactory())
            ->getFactory($container['proxy_manager_cache_target_dir']);
    };
    $pimpleContainer['lazy_service_factory'] = function (Container $container) {
        return new LazyServiceFactory($container['lazy_loading_value_holder_factory_factory']);
    };
    $pimpleContainer['proxy_manager_cache_target_dir'] = function (Container $container) {
        $targetDir = APP_PATH . '/proxy_cache_dir';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }
        return $targetDir;
    };
    $pimpleContainer['errorHandler'] = function (Container $container) {
        return function ($request, $response, $exception) use ($container) {
            $container['logger']->error($exception);
            if (\Boot\Bootstrap::getConfig('customer')['is_rest']) {
                return $container['response']
                    ->withStatus(500)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson(['code' => 500, 'msg' => '500 status', 'data' => []]);
            } else {
                $body = new Body(@fopen(TEMPLATE_PATH . 'templates/error.twig', 'r'));
                return $container['response']
                    ->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->withBody($body);
            };
        };
    };
    $pimpleContainer['notFoundHandler'] = function (Container $container) {
        return function ($request, $response) use ($container) {
            if (\Boot\Bootstrap::getConfig('customer')['is_rest']) {
                return $container['response']
                    ->withStatus(404)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson(['code' => 1, 'msg' => '404', 'data' => []]);
            } else {
                $body = new Body(@fopen(TEMPLATE_PATH . 'templates/404.twig', 'r'));
                return $container['response']
                    ->withStatus(404)
                    ->withHeader('Content-Type', 'text/html')
                    ->withBody($body);
            }
        };
    };
    $pimpleContainer['phpErrorHandler'] = function (Container $container) {
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
    };
    $pimpleContainer['config'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Noodlehaus\Config::class, function () use ($container) {
            return new \Noodlehaus\Config(APP_PATH . 'config');
        });
    };
    registerServiceContainer($pimpleContainer);
    if (function_exists('registerCustomerContainer')) {
        registerCustomerContainer($pimpleContainer);
    }
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
            $twig_config = \Boot\Bootstrap::getConfig('twig') ? \Boot\Bootstrap::getConfig('twig') : [];
            $view = new Twig(TEMPLATE_PATH . 'templates', $twig_config);
            $view->addExtension(new TwigExtension($container['router'], $container['request']->getUri()));
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
            $settings = \Boot\Bootstrap::getConfig('slim')['settings'];
            $logger = new Logger($settings['logger']['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['logger']['path'], $settings['logger']['level']));
            return $logger;
        });
    };
    /*Doctrine2 Memcache Driver*/
    $container["memcacheCacheDriver"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\MemcacheCache::class, function ($server_name = 'server1') use ($container) {
            $memcache = \Boot\Bootstrap::getCacheInstance(\Boot\Bootstrap::MEMCACHE, $container['server_name']);
            writeLog("debug", [$container['server_name']], APP_PATH . '/error.log');
            $memcacheCacheDriver = new MemcacheCache();
            $memcacheCacheDriver->setNamespace("memcacheCacheDriver_namespace");
            $memcacheCacheDriver->setMemcache($memcache);
            return $memcacheCacheDriver;
        });
    };
    /*Doctrine2 Redis Driver*/
    $container["redisCacheDriver"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\RedisCache::class, function () use ($container) {
            $redisCacheDriver = new RedisCache();
            $redis = \Boot\Bootstrap::getCacheInstance(\Boot\Bootstrap::REDIS, 'server1');
            //设置缓存的命名空间
            $redisCacheDriver->setNamespace('redisCacheDriver_namespace');
            $redisCacheDriver->setRedis($redis);
            return $redisCacheDriver;
        });
    };
    /*ZendFrameWork Redis Object*/
    $container["redisCache"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Redis::class, function () use ($container) {
            $redisConfig = \Boot\Bootstrap::getConfig("cache");
            $redis = NULL;
            if ($redisConfig['redis']) {
                $redis = new \Zend\Cache\Storage\Adapter\Redis();
                //设置缓存的命名空间
                $redis->getOptions()->getResourceManager()->setResource('default', \Boot\Bootstrap::getCacheInstance(\Boot\Bootstrap::REDIS, 'server1'));
                $redis->getOptions()->setNamespace('redisCache_namespace');
            }
            return $redis;
        });
    };
    /*ZendFrameWork Memcache Object*/
    $container["memcacheCache"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Doctrine\Common\Cache\MemcacheCache::class, function () use ($container) {
            $memcacheConfig = \Boot\Bootstrap::getConfig("cache");
            $memcache = NULL;
            if ($memcacheConfig['memcache']) {
                $memcache = new \Zend\Cache\Storage\Adapter\Memcache();
                $server_name = 'server1';
                //设置缓存的命名空间
                $memcache->getOptions()->getResourceManager()->setResource('default', \Boot\Bootstrap::getCacheInstance(\Boot\Bootstrap::MEMCACHE, $server_name));
                $memcache->getOptions()->setNamespace($memcacheConfig['memcache'][$server_name]['namespace']);
            }
            return $memcache;
        });
    };
    /*ZendFrameWork Memcached Object*/
    $container['memcachedCache'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Cache\Storage\Adapter\Memcached::class, function () use ($container) {
            $memcachedConfig = \Boot\Bootstrap::getConfig('cache');
            $memcached = NULL;
            if ($memcachedConfig['memcached']) {
                $memcached = new \Zend\Cache\Storage\Adapter\Memcached();
                $server_name = 'server1';
                $memcached->getOptions()->getResourceManager()->setResource('default', \Boot\Bootstrap::getCacheInstance(\Boot\Bootstrap::MEMCACHED, $server_name));
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
            $config->setOptions(\Boot\Bootstrap::getConfig("session")['manager']);
            $sessionManager = new \Zend\Session\SessionManager($config);
            $sessionManager->setStorage(new \Zend\Session\Storage\SessionArrayStorage());
            $sessionManager->start();
            return $sessionManager;
        });
    };
    /*SessionManager Container Object*/
    $container["sessionContainer"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\Session\Container::class, function () use ($container) {
            $sessionManager = \Boot\Bootstrap::getContainer("sessionManager");
            \Zend\Session\Container::setDefaultManager($sessionManager);
            $container = new \Zend\Session\Container(\Boot\Bootstrap::getConfig("session")['container']['namespace']);
            return $container;
        });
    };

    /*Event Manager Object*/
    $container["eventManager"] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\EventManager\Event::class, function () {
            return new EventManager();
        });
    };
    /*Zend ServiceManager*/
    $container['serviceManager'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Zend\ServiceManager\ServiceManager::class, function () {
            $serviceManager = new ServiceManager();
            return $serviceManager;
        });
    };

    /**/
    $container['server_name'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(stdClass::class, function () {
            return 'server1';
        });
    };
    return $container;
}


function containerDefinition()
{
    $pimpleContainer['event_dispatcher'] = function (Container $container) {
        return new EventDispatcher();
    };
    // imgine awesome service is expensive and should be lazy loaded
    $pimpleContainer['awesome_service'] = function (Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(AwesomeService::class, function () {
            return new AwesomeService();
        });
    };
    $pimpleContainer['another_service'] = function (Container $container) {
        // this one will receive proxy object
        return new AnotherService($container['awesome_service']);
    };
    $pimpleContainer['event_emitting_service'] = function (Container $container) {
        return new EventEmittingService($container['event_dispatcher']);
    };
    $pimpleContainer['first_subscriber'] = function (Container $container) {
        // subscriber has no idea it will be lazy loaded
        return new FirstSubscriber($container['awesome_service']);
    };
    $pimpleContainer['awesome_service_aware'] = function (Container $container) {
        return new AwesomeServiceAwareClass();
    };
    $pimpleContainer['both_interfaces_aware'] = function (Container $container) {
        return new BothInterfacesAwareClass();
    };
    $pimpleContainer->register(new MultiServiceAwareExtender([
        new ExtendServiceDefinition('awesome_service', AwesomeServiceAwareInterface::class, 'setAwesomeService'),
        new ExtendServiceDefinition('event_dispatcher', EventDispatcherAwareInterface::class, 'setEventDispatcher'),
    ]));
    $pimpleContainer->register(new LazyEventSubscriberServiceProvider(
        $pimpleContainer['lazy_service_factory'],
        // we're defining which service resolves to EventDispatcher
        'event_dispatcher',
        [
            // we're defining subscribers
            'first_subscriber' => \Blog\subscriber\FirstSubscriber::class,
        ]
    ));
    return $pimpleContainer;
}
