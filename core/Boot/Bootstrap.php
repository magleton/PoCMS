<?php
namespace Boot;

use Doctrine\Common\Cache\ApcuCache;
use Doctrine\Common\Cache\XcacheCache;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Slim\Http\Body;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\MemcacheCache;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Config\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Storage\SessionStorage;
use think\slog\SLog;

class Bootstrap
{
    private static $app = NULL;

    /**
     * 配置entityManager的事件映射对象，因为addEventListener不能识别config.php配置的字符串，因此设置此映射数组
     *
     * @var \Doctrine\ORM\Events $eventTypeMapping
     */
    private static $eventTypeMapping = array(
        "Events::prePersist" => \Doctrine\ORM\Events::prePersist,
        "Events::preFlush" => \Doctrine\ORM\Events::preFlush,
        "Events::preUpdate" => \Doctrine\ORM\Events::preUpdate,
        "Events::preRemove" => \Doctrine\ORM\Events::preRemove,
    );

    /**
     * 缓存的类型
     */
    const REDIS = "redis";
    const MEMCACHE = "memcache";
    const MEMCACHED = 'memcached';

    /**
     * 引导应用
     *
     * @author macro chen <macro_fengye@163.com>
     */
    public static function start()
    {
        if (APPLICATION_ENV == 'production') {
            if (!ini_get('display_errors')) {
                ini_set('display_errors', 'off');
            }
            error_reporting(0);
        }
        try {
            $slim_config = self::getConfig('slim') ? self::getConfig('slim')->toArray() : [];
            self::$app = new \Slim\App($slim_config);
            self::initContainer();
            self::dealRoute();
            register_shutdown_function('fatal_handler');
            self::$app->run();
        } catch (\Exception $e) {

        }
        if (self::getConfig('customer')['show_use_memory']) {
            echo "分配内存量 : " . convert(memory_get_usage(true));
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "内存的峰值 : " . convert(memory_get_peak_usage(true));
        }
    }

    /**
     * 引导控制台的引用，包括单元测试及其他的控制台程序(定时任务等...)
     *
     * @author macro chen <macro_fengye@163.com>
     */
    public static function startConsole()
    {
        if (APPLICATION_ENV == 'production') {
            if (!ini_get('display_errors')) {
                ini_set('display_errors', 'off');
            }
            error_reporting(0);
        }
        $slim_config = self::getConfig('slim') ? self::getConfig('slim')->toArray() : [];
        self::$app = new \Slim\App($slim_config);
        self::initContainer();
    }

    /**
     * 初始化依赖管理器
     *
     * @author macro chen <macro_fengye@163.com>
     */
    private static function initContainer()
    {
        $container = self::$app->getContainer();
        $container['errorHandler'] = function ($container) {
            return function ($request, $response, $exception) use ($container) {
                //self::getContainer('logger')->error((string)$exception);
                self::getContainer('logger')->error($exception);
                if (self::getConfig('customer')['is_rest']) {
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
        $container['notFoundHandler'] = function ($container) {
            return function ($request, $response) use ($container) {
                if (self::getConfig('customer')['is_rest']) {
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
        $container['phpErrorHandler'] = function ($container) {
            return $container['errorHandler'];
        };
        $container['notAllowedHandler'] = function ($container) {
            return function ($request, $response, $methods) use ($container) {
                return $container['response']
                    ->withStatus(405)
                    ->withHeader('Allow', implode(', ', $methods))
                    ->withHeader('Content-type', 'text/html')
                    ->write('Method must be one of: ' . implode(', ', $methods));
            };
        };
        $container['view'] = function ($container) {
            $twig_config = self::getConfig('twig') ? self::getConfig('twig')->toArray() : [];
            $view = new Twig(TEMPLATE_PATH . 'templates', $twig_config);
            $view->addExtension(new TwigExtension($container['router'], $container['request']->getUri()));
            return $view;
        };
        $container['csrf'] = function ($container) {
            $guard = new \Slim\Csrf\Guard();
            $guard->setFailureCallable(function ($request, $response, $next) {
                $request = $request->withAttribute("csrf_status", false);
                return $next($request, $response);
            });
            return $guard;
        };
        $container['apcu'] = function ($container) {
            return new ApcuCache();
        };
        $container['xcache'] = function ($container) {
            return new XcacheCache();
        };
        $container['flash'] = function ($container) {
            return new \Slim\Flash\Messages();
        };
        /* Monolog */
        $container['logger'] = function ($container) {
            $settings = self::getConfig('slim')['settings'];
            $logger = new Logger($settings['logger']['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['logger']['path'], $settings['logger']['level']));
            return $logger;
        };
        /*Doctrine2 Memcache Driver*/
        $container["memcacheCacheDriver"] = function ($container) {
            $memcache = self::getCacheInstance(self::MEMCACHE, 'server1');
            $memcacheCacheDriver = new MemcacheCache();
            $memcacheCacheDriver->setNamespace("memcacheCacheDriver_namespace");
            $memcacheCacheDriver->setMemcache($memcache);
            return $memcacheCacheDriver;
        };
        /*Doctrine2 Redis Driver*/
        $container["redisCacheDriver"] = function ($container) {
            $redisCacheDriver = new RedisCache();
            $redis = self::getCacheInstance(self::REDIS, 'server1');
            //设置缓存的命名空间
            $redisCacheDriver->setNamespace('redisCacheDriver_namespace');
            $redisCacheDriver->setRedis($redis);
            return $redisCacheDriver;
        };
        /*ZendFrameWork Redis Object*/
        $container["redisCache"] = function ($container) {
            $redisConfig = self::getConfig("cache");
            $redis = NULL;
            if ($redisConfig->redis) {
                $redis = new \Zend\Cache\Storage\Adapter\Redis();
                //设置缓存的命名空间
                $redis->getOptions()->getResourceManager()->setResource('default', self::getCacheInstance(self::REDIS, 'server1'));
                $redis->getOptions()->setNamespace('redisCache_namespace');
            }
            return $redis;
        };
        /*ZendFrameWork Memcache Object*/
        $container["memcacheCache"] = function ($container) {
            $memcacheConfig = self::getConfig("cache");
            $memcache = NULL;
            if ($memcacheConfig->memcache) {
                $memcache = new \Zend\Cache\Storage\Adapter\Memcache();
                $server_name = 'server1';
                //设置缓存的命名空间
                $memcache->getOptions()->getResourceManager()->setResource('default', self::getCacheInstance(self::MEMCACHE, $server_name));
                $memcache->getOptions()->setNamespace($memcacheConfig->memcache->$server_name->namespace);
            }
            return $memcache;
        };
        /*ZendFrameWork Memcached Object*/
        $container['memcachedCache'] = function ($container) {
            $memcachedConfig = self::getConfig('cache');
            $memcached = NULL;
            if ($memcachedConfig->memcached) {
                $memcached = new Memcached();
                $server_name = 'server1';
                $memcached->getOptions()->getResourceManager()->setResource('default', self::getCacheInstance(self::MEMCACHED, $server_name));
                $memcached->getOptions()->setNamespace($memcachedConfig->memcached->$server_name->namespace);
            }
            return $memcached;
        };
        /*ZendFrameWork FileSystemCache*/
        $container["fileSystemCache"] = function ($container) {
            $fileSystem = new Filesystem(array(
                "cache_dir" => CACHE_DIR . "/cache"
            ));
            return $fileSystem;
        };
        /*SessionManager Object*/
        $container['sessionManager'] = function ($container) {
            $config = new SessionConfig();
            $config->setOptions(self::getConfig("session")['manager']);
            $sessionManager = new SessionManager($config);
            $sessionManager->setStorage(new SessionArrayStorage());
            $sessionManager->start();
            return $sessionManager;
        };
        /*SessionManager Container Object*/
        $container["sessionContainer"] = function ($container) {
            $sessionManager = self::getContainer("sessionManager");
            Container::setDefaultManager($sessionManager);
            $container = new Container(self::getConfig("session")['container']['namespace']);
            return $container;
        };

        /*Event Manager Object*/
        $container["eventManager"] = function ($container) {
            return new EventManager();
        };
        /*Zend ServiceManager*/
        $container['serviceManager'] = function ($container) {
            $serviceManager = new ServiceManager();
            return $serviceManager;
        };

        /* SocketLog Container Object */
        $container['slog'] = function ($container) {
            return new SLog();
        };
    }

    /**
     * 根据不同的数据库链接类型，实例化不同的数据库链接对象
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == driverManager支持分库分表
     * @param $dbName string
     * @throws \Doctrine\ORM\ORMException
     * @return array
     */
    private static function databaseConnection($type, $dbName)
    {
        $dbConfig = self::getConfig('db')[APPLICATION_ENV];
        $db = NULL;
        if (isset($dbConfig[$dbName]) && $dbConfig[$dbName]) {
            $conn_config = $dbConfig->$dbName ? $dbConfig->$dbName->toArray() : [];
            $useSimpleAnnotationReader = $conn_config['useSimpleAnnotationReader'];
            unset($conn_config['useSimpleAnnotationReader']);
            if ($useSimpleAnnotationReader) {
                $configuration = Setup::createConfiguration(APPLICATION_ENV == 'development');
                $configuration->setMetadataCacheImpl(self::getContainer(self::getConfig('customer')['doctrine_metadata_cache']['cache_name']));
                $annotationDriver = new AnnotationDriver(new AnnotationReader(), MODEL_PATH . "/models/Entity");
                AnnotationRegistry::registerLoader("class_exists");
                $configuration->setMetadataDriverImpl($annotationDriver);
            } else {
                $configuration = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(
                    MODEL_PATH . '/models/Entity/',
                ), APPLICATION_ENV == 'development', MODEL_PATH . '/models/Proxies/', self::getContainer(self::getConfig('customer')['doctrine_metadata_cache']['cache_name']), $useSimpleAnnotationReader);
                /*  $configuration = \Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(array(
                    MODEL_PATH . "/data/Yaml/"
                    ), APPLICATION_ENV == 'development', MODEL_PATH . '/data/Proxies/', self::$pimpleContainer["memcacheCacheDriver"]), */
            }
            if (APPLICATION_ENV == "development") {
                $configuration->setAutoGenerateProxyClasses(true);
            } else {
                $configuration->setAutoGenerateProxyClasses(false);
            }
            //设置缓存组件
            if (self::getConfig('customer')['doctrine_query_cache']['is_open']) {
                $configuration->setQueryCacheImpl(self::getContainer(self::getConfig('customer')['doctrine_query_cache']['cache_name']));
            }
            if (self::getConfig('customer')['doctrine_result_cache']['is_open']) {
                $configuration->setResultCacheImpl(self::getContainer(self::getConfig('customer')['doctrine_result_cache']['cache_name']));
            }
            if ($type == "entityManager") {
                $db = \Doctrine\ORM\EntityManager::create($conn_config
                    , $configuration, self::getContainer("eventManager"));
            } else if ($type == "Connection") {
                $db = DriverManager::getConnection($conn_config
                    , $configuration, self::getContainer("eventManager"));
            }
        }
        if (!self::getContainer("dataBase" . $type . $dbName)) {
            $container = self::$app->getContainer();
            $container["dataBase" . $type . $dbName] = $db;
        }
        return $db;
    }

    /**
     * 获取指定键的配置文件
     *
     * @author macro chen <macro_fengye@163.com>
     * @params string $first_key
     * @params string $second_key
     * @return mixed
     */
    public static function getConfig($key)
    {
        /*App Config*/
        $config_data = [];
        foreach (glob(CONFIG_PATH . "config/*.php") as $filename) {
            $temp = require $filename;
            if (is_array($temp)) {
                $config_data = array_merge($config_data, $temp);
            }
        }
        $config = new Config($config_data);
        if (!$config->$key) {
            echo "{$key}不存在！";
            return NULL;
        }
        return $config->$key;
    }

    /**
     * 获取APP
     * @author macro chen <macro_fengye@163.com>
     * @return \Slim\App
     */
    public static function getApp()
    {
        return self::$app;
    }

    /**
     * 处理动态路由
     */
    private static function dealRoute()
    {
        $path_info = self::$app->getContainer()->get('request')->getUri()->getPath();
        $path_arr = explode("/", trim($path_info, '/'));
        $controller = (isset($path_arr[0]) && !empty($path_arr[0])) ? $path_arr[0] : "home";
        $action = (isset($path_arr[1]) && !empty($path_arr[1])) ? $path_arr[1] : "index";
        $route_name = APP_NAME . '.' . $controller . '.' . $action;
        self::getContainer('sessionContainer')->current_path_arr = $path_arr;
        $isDynamicAddRoute = true;
        if (!method_exists(APP_NAME . "\\controller\\" . ucfirst($controller), $action)) {
            return;
        }
        if (isset(self::getConfig('customer')['is_cross_domain']) && self::getConfig('customer')['is_cross_domain']) {
            //self::$app->add('crossDomain');
            self::$app->add(new \Tuupola\Middleware\Cors([
                "origin" => ["*"],
                "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE", "OPTIONS"],
                "headers.allow" => ["token", "Content-Type", "Accept", "Origin", "User-Agent", "DNT", "Cache-Control", "X-Mx-ReqToken", "Keep-Alive", "X-Requested-With", "If-Modified-Since"],
                "headers.expose" => ["Etag"],
                "credentials" => true,
                "cache" => 0,
                "error" => function ($request, $response, $arguments) {
                    $data["status"] = "error";
                    $data["msg"] = $arguments["message"];
                    $data['code'] = 99;
                    return $response
                        ->withHeader("Content-Type", "application/json")
                        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                }
            ]));
        }
        if (file_exists(ROUTER_PATH . '/routes/' . $controller . '_route.php')) {
            require_once ROUTER_PATH . '/routes/' . $controller . '_route.php';
            try {
                if (self::$app->getContainer()->get('router')->getNamedRoute($route_name)) {
                    $isDynamicAddRoute = false;
                } else {
                    $isDynamicAddRoute = true;
                }
            } catch (\RuntimeException $e) {
                $isDynamicAddRoute = true;
            };
        }
        if ($isDynamicAddRoute) {
            $route = APP_NAME . "\\controller\\" . ucfirst($controller) . ":" . $action;
            $pattern = "/";
            if (isset($path_arr[0]) && !isset($path_arr[1])) {
                $pattern .= $controller . '[/]';
            } else {
                $pattern .= $controller . '/' . $action . '[/{param:.*}]';
            }
            self::$app->map(["GET", "POST", "PUT", "PATCH", "DELETE", "OPTIONS"], $pattern, $route)->setName($route_name);
            if (isset(self::getConfig('customer')['is_check_permission']) && self::getConfig('customer')['is_check_permission']) {
                self::$app->add('checkPermission');
            }
            if (isset(self::getConfig('customer')['is_check_login']) && self::getConfig('customer')['is_check_login']) {
                self::$app->add('checkLogin');
            }
        }
    }

    /**
     * 添加系统配置的事件（监听器，订阅器）
     *
     * @author macro chen <macro_fengye@163.com>
     */
    private static function addSystemEvent()
    {
        if (self::getConfig("evm")) {
            self::addEvent(self::getConfig("evm"));
        }
    }

    /**
     * 添加自定义的事件（监听器，订阅器）
     *
     * @param array $evm
     * @author macro chen <macro_fengye@163.com>
     * @return mixed
     */

    private static function addCustomEvent(array $evm = array())
    {
        if ($evm) {
            return self::addEvent(self::getConfig("evm"));
        }
        return NULL;
    }

    /**
     * 添加事件到事件管理器
     *
     * @param $evm array 需要添加的事件
     * @author macro chen <macro_fengye@163.com>
     * @return  mixed
     */
    private static function addEvent(array $evm = array())
    {
        if (isset($evmConfig['listener'])) {
            foreach ($evmConfig['listener'] as $key => $listener) {
                self::getContainer('eventManager')->addEventListener(array(
                    self::$eventTypeMapping[$key],
                ), new $listener());
            }
        }
        if (isset($evmConfig['subscriber'])) {
            foreach ($evmConfig['subscriber'] as $key => $subscriber) {
                self::getContainer('eventManager')->addEventSubscriber(new $subscriber());
            }
            return self::getContainer('eventManager');
        }
    }

    /**
     * 获取指定数据库实例的事件组件
     * @author macro chen <macro_fengye@163.com>
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == Connection 支持分库分表
     * @param string $dbName
     * @param string $dbName
     * @return \Doctrine\Common\EventManager
     */
    public static function getDbInstanceEvm($type, $dbName)
    {
        if (self::getContainer("dataBase" . $type . $dbName)) {
            $db = self::getContainer("dataBase" . $type . $dbName);
        } else {
            $db = self::databaseConnection($type, $dbName);
        }
        return $db->getEventManager();
    }

    /**
     * 获取数据库的实例
     * @author macro chen <macro_fengye@163.com>
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == Connection 支持分库分表
     * @param string $dbName
     * @return \Doctrine\Common\EventManager
     */
    public static function getDbInstance($type, $dbName)
    {
        if (self::getContainer("dataBase" . $type . $dbName)) {
            $db = self::getContainer("dataBase" . $type . $dbName);
        } else {
            $db = self::databaseConnection($type, $dbName);
        }
        return $db;
    }

    /**
     * 获取缓存的实例
     * @author macro chen <macro_fengye@163.com>
     * @param $type 缓存的类型
     * @param string $server_name 服务器的名字
     * @param bool $lookup 是否继续寻找其他的服务器是否可以链接
     * @return mixed
     */
    public static function getCacheInstance($type, $server_name, $lookup = true)
    {
        $config = self::getConfig('cache');
        $cache_obj = NULL;
        $is_conn = 0;
        if ($config) {
            switch ($type) {
                case self::REDIS:
                    $cache_obj = new \Redis();
                    $is_conn = $cache_obj->connect($config->$type->$server_name->host, $config->$type->$server_name->port, $config->$type->$server_name->timeout);
                    if (!$is_conn && $lookup) {
                        foreach ($config->$type as $key => $value) {
                            if ($key != $server_name) {
                                $is_conn = $cache_obj->connect($value->host, $value->port, $value->timeout);
                                if ($is_conn) {
                                    break;
                                }
                            }
                        }
                    }
                    break;
                case self::MEMCACHE:
                    $cache_obj = new \Memcache();
                    $is_conn = $cache_obj->connect($config->$type->$server_name->host, $config->$type->$server_name->port, $config->$type->$server_name->timeout);
                    if (!$is_conn && $lookup) {
                        foreach ($config->$type as $key => $value) {
                            if ($key != $server_name) {
                                $is_conn = $cache_obj->connect($value->host, $value->port, $value->timeout);
                                if ($is_conn) {
                                    break;
                                }
                            }
                        }
                    }
                    break;
                case self::MEMCACHED:
                    $cache_obj = new \Memcached();
                    $is_conn = $cache_obj->addServer($config->$type->$server_name->host, $config->$type->$server_name->port, $config->$type->$server_name->weight);
                    if (!$is_conn && $lookup) {
                        foreach ($config->$type as $key => $value) {
                            if ($key != $server_name) {
                                $is_conn = $cache_obj->addServer($value->host, $value->port, $value->weight);
                                if ($is_conn) {
                                    break;
                                }
                            }
                        }
                    }
                    break;
                default:
                    $cache_obj = NULL;
                    $is_conn = 0;
                    break;
            }
        }
        return $is_conn ? $cache_obj : NULL;
    }

    /**
     * 获取指定组件名字的对象
     *
     * @param $componentName
     * @return mixed
     */
    public static function getContainer($componentName)
    {
        if (self::getApp()->getContainer()->offsetExists($componentName)) {
            return self::getApp()->getContainer()->get($componentName);
        }
        return null;
    }
}