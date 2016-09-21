<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/21
 * Time: 18:02
 */

namespace Core\Boot;


use Slim\Container;
use Core\ServiceProvider\InitAppService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Monolog\Logger;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

final class Application
{
    const ENTITY = "entityManager";
    const CONNECTION = "Connection";

    const REDIS = "redis";
    const MEMCACHE = "memcache";
    const MEMCACHED = 'memcached';

    /**
     * 整个应用的实例
     *
     * @var $this
     */
    protected static $instance;

    /**
     * 应用的服务容器
     *
     * @var null
     */
    private $container = NULL;

    /**
     * 引导WEB应用
     *
     * @author macro chen <macro_fengye@163.com>
     */
    public function start()
    {
        try {
            $this->initEnvironment();
            $this->getContainer('routerFile');
            $this->getContainer('app')->run();
        } catch (\Exception $e) {
            echo \GuzzleHttp\json_encode(['code' => 1000, 'msg' => $e->getMessage(), 'data' => []]);
            return false;
        }
        if ($this->getConfig('customer')['show_use_memory']) {
            echo "分配内存量 : " . convert(memory_get_usage(true));
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "内存的峰值 : " . convert(memory_get_peak_usage(true));
        }
    }

    /**
     * 启动控制台，包括单元测试及其他的控制台程序(定时任务等...)
     *
     * @author macro chen <macro_fengye@163.com>
     */
    public function startConsole()
    {
        try {
            $this->initEnvironment();
        } catch (\Exception $e) {
            echo \GuzzleHttp\json_encode(['code' => 1000, 'msg' => $e->getMessage(), 'data' => []]);
            return false;
        }
        if ($this->getConfig('customer')['show_use_memory']) {
            echo "分配内存量 : " . convert(memory_get_usage(true));
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "内存的峰值 : " . convert(memory_get_peak_usage(true));
        }
    }


    /**
     * 初始化应用的环境
     *
     * @author macro chen <macro_fengye@163.com>
     */
    private function initEnvironment()
    {
        if (APPLICATION_ENV == 'production') {
            if (!ini_get('display_errors')) {
                ini_set('display_errors', 'off');
            }
            error_reporting(0);
        }
        register_shutdown_function('fatal_handler');
        $this->container = new Container();
        $this->container->register(new InitAppService());
        $this->container['application'] = $this;
        static::setInstance($this);
    }

    /**
     * 根据不同的数据库链接类型，实例化不同的数据库链接对象
     *
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == driverManager支持分库分表
     * @param $dbName string
     * @throws \Doctrine\ORM\ORMException
     * @return array
     */
    public function getDbInstance($type, $dbName)
    {
        if (!$this->getContainer("dataBase" . $type . $dbName)) {
            $dbConfig = $this->getConfig('db')[APPLICATION_ENV];
            $db = NULL;
            if (isset($dbConfig[$dbName]) && $dbConfig[$dbName]) {
                $doctrine_config = $this->getConfig('doctrine');
                $conn_config = $dbConfig[$dbName] ? $dbConfig[$dbName] : [];
                $useSimpleAnnotationReader = $conn_config['useSimpleAnnotationReader'];
                unset($conn_config['useSimpleAnnotationReader']);
                $metadata_cache = $this->getContainer($doctrine_config['metadata_cache']['cache_name'], ['database' => $doctrine_config['metadata_cache']['database']]);
                if ($useSimpleAnnotationReader) {
                    $configuration = Setup::createConfiguration(APPLICATION_ENV == 'development');
                    $configuration->setMetadataCacheImpl($metadata_cache);
                    $annotationDriver = new AnnotationDriver(new AnnotationReader(), ROOT_PATH . "/entity/Models");
                    AnnotationRegistry::registerLoader("class_exists");
                    $configuration->setMetadataDriverImpl($annotationDriver);
                } else {
                    $configuration = Setup::createAnnotationMetadataConfiguration([
                        ROOT_PATH . '/entity/Models',
                    ], APPLICATION_ENV == 'development', ROOT_PATH . '/entity/Proxies/', $metadata_cache, $useSimpleAnnotationReader);
                }
                if (APPLICATION_ENV == "development") {
                    $configuration->setAutoGenerateProxyClasses(true);
                } else {
                    $configuration->setAutoGenerateProxyClasses(true);
                }
                //设置缓存组件
                if ($doctrine_config['query_cache']['is_open']) {
                    $query_cache = $this->getContainer($this->getConfig('doctrine')['query_cache']['cache_name'], ['database' => $doctrine_config['metadata_cache']['database']]);
                    $configuration->setQueryCacheImpl($query_cache);
                }
                if ($doctrine_config['result_cache']['is_open']) {
                    $result_cache = $this->getContainer($this->getConfig('doctrine')['result_cache']['cache_name'], ['database' => $doctrine_config['metadata_cache']['database']]);
                    $configuration->setResultCacheImpl($result_cache);
                }
                if ($type == self::ENTITY) {
                    $db = EntityManager::create($conn_config
                        , $configuration, $this->getContainer("eventManager"));
                } else if ($type == self::CONNECTION) {
                    $db = DriverManager::getConnection($conn_config
                        , $configuration, $this->getContainer("eventManager"));
                }
            }
            $this->container["dataBase" . $type . $dbName] = $db;
        }
        return $this->container["dataBase" . $type . $dbName];
    }

    /**
     * 获取指定键的配置文件
     *
     * @author macro chen <macro_fengye@163.com>
     * @param string $key
     * @return mixed
     */
    public function getConfig($key)
    {
        if (!$this->getContainer('config')->get($key)) {
            writeLog('获取', [$key . '--不存在!', debug_backtrace()], APP_PATH . '/log/config.log', Logger::ERROR);
            return NULL;
        }
        return $this->getContainer('config')->get($key);
    }

    /**
     * 添加自定义监听器
     *
     * @author macro chen <macro_fengye@163.com>
     * @param array $params
     * @throws \Exception
     * @return EventManager
     */
    public function addEvent(array $params = [])
    {
        $event_manager = $this->getContainer('doctrineEventManager');
        $reflect = null;
        foreach ($params as $key => $value) {
            if (!isset($value['class_name'])) {
                throw new \Exception("class_name必须设置");
            }
            $class_name = $value['class_name'];
            $data = isset($value['data']) ? $value['data'] : [];
            if ($reflect == null) {
                $reflect = new \ReflectionClass(Events::class);
            }
            if ($reflect->getConstant($key)) {
                if (!isset($value['type'])) {
                    throw new \Exception("type必须设置");
                }
                if (!isset($value['dbName'])) {
                    throw new \Exception("dbName必须设置");
                }
                $db_eventManager = $this->getDbInstance($value['type'], $value['dbName'])->getEventManager();
                $db_eventManager->addEventListener($key, new $class_name($data));
                continue;
            }
            $event_manager->addEventListener($key, new $class_name($data));
        }
        return $event_manager;
    }

    /**
     * 添加自定义订阅器
     *
     * @author macro chen <macro_fengye@163.com>
     * @param array $params
     * @throws \Exception
     * @return EventManager
     */
    public function addSubscriber(array $params = [])
    {
        $event_manager = $this->getContainer('doctrineEventManager');
        $reflect = null;
        foreach ($params as $key => $value) {
            if (!isset($value['class_name'])) {
                throw new \Exception("class_name必须设置");
            }
            $class_name = $value['class_name'];
            $data = $value['data'];
            if ($reflect == null) {
                $reflect = new \ReflectionClass(Events::class);
            }
            if ($reflect->getConstant($key)) {
                if (!isset($value['type'])) {
                    throw new \Exception("type必须设置");
                }
                if (!isset($value['dbName'])) {
                    throw new \Exception("dbName必须设置");
                }
                $db_eventManager = $this->getDbInstance($value['type'], $value['dbName'])->getEventManager();
                $db_eventManager->addEventSubscriber(new $class_name($data));
                continue;
            }
            $event_manager->addEventSubscriber(new $class_name($data));
        }
        return $event_manager;
    }

    /**
     * 获取拥有命名明空间的缓存实例
     *
     * @param $cache_type
     * @param array $params
     * @deprecated
     * @throws \Exception
     * @return mixed
     */
    public function getCacheInstanceHaveNamespace($cache_type, array $params = [])
    {
        if (!isset($params['resource_id'])) {
            throw new \Exception('资源ID必须设置', 400);
        }
        $resource_id = $params['resource_id'];
        unset($params['resource_id']);
        $cache = $this->getContainer($cache_type . 'Cache', $params)->getOptions()->getResourceManager()->getResource($resource_id);
        return $cache;
    }

    /**
     * 获取指定组件名字的对象
     *
     * @param $component_name
     * @param array $param
     * @return mixed|null
     */
    public function getContainer($component_name, $param = [])
    {
        if (!$this->container->has($component_name)) {
            $class_name = '';
            if (!defined('SERVICE_NAMESPACE')) define('SERVICE_NAMESPACE', APP_NAME);
            if (class_exists(SERVICE_NAMESPACE . '\\Service\\' . ucfirst($component_name) . "Service")) {
                $class_name = SERVICE_NAMESPACE . '\\Service\\' . ucfirst($component_name) . "Service";
            } else if (class_exists('Core\\ServiceProvider\\' . ucfirst($component_name) . "Service")) {
                $class_name = 'Core\\ServiceProvider\\' . ucfirst($component_name) . "Service";
            }
            if ($class_name) {
                $this->container->register(new $class_name(), $param);
            } else {
                return null;
            }
        }
        $cacheObj = $this->container->get($component_name);
        if ($component_name === self::REDIS && isset($param['database']) && $param['database']) {
            $cacheObj->select($param['database']);
        }
        return $cacheObj;
    }


    /**
     * Set the globally available instance of the container.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set the shared instance of the container.
     *
     * @return static
     */
    public static function setInstance($application = null)
    {
        return static::$instance = $application;
    }

}