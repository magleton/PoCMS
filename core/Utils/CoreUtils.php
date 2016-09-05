<?php
namespace Core\Utils;

use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Core\Boot\Bootstrap;

class CoreUtils
{
    const ENTITY = "entityManager";
    const CONNECTION = "Connection";

    const REDIS = "redis";
    const MEMCACHE = "memcache";
    const MEMCACHED = 'memcached';

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
    public static function getDbInstance($type, $dbName)
    {
        if (!self::getContainer("dataBase" . $type . $dbName)) {
            $dbConfig = self::getConfig('db')[APPLICATION_ENV];
            $db = NULL;
            if (isset($dbConfig[$dbName]) && $dbConfig[$dbName]) {
                $conn_config = $dbConfig[$dbName] ? $dbConfig[$dbName] : [];
                $useSimpleAnnotationReader = $conn_config['useSimpleAnnotationReader'];
                unset($conn_config['useSimpleAnnotationReader']);
                if ($useSimpleAnnotationReader) {
                    $configuration = Setup::createConfiguration(APPLICATION_ENV == 'development');
                    $configuration->setMetadataCacheImpl(self::getContainer(self::getConfig('doctrine')['metadata_cache']['cache_name']));
                    $annotationDriver = new AnnotationDriver(new AnnotationReader(), ROOT_PATH . "/entity/Models");
                    AnnotationRegistry::registerLoader("class_exists");
                    $configuration->setMetadataDriverImpl($annotationDriver);
                } else {
                    $configuration = Setup::createAnnotationMetadataConfiguration(array(
                        ROOT_PATH . '/entity/Models',
                    ), APPLICATION_ENV == 'development', ROOT_PATH . '/entity/Proxies/', self::getContainer(self::getConfig('doctrine')['metadata_cache']['cache_name']), $useSimpleAnnotationReader);
                }
                if (APPLICATION_ENV == "development") {
                    $configuration->setAutoGenerateProxyClasses(true);
                } else {
                    $configuration->setAutoGenerateProxyClasses(true);
                }
                //设置缓存组件
                if (self::getConfig('doctrine')['query_cache']['is_open']) {
                    $configuration->setQueryCacheImpl(self::getContainer(self::getConfig('doctrine')['query_cache']['cache_name']));
                }
                if (self::getConfig('doctrine')['result_cache']['is_open']) {
                    $configuration->setResultCacheImpl(self::getContainer(self::getConfig('doctrine')['result_cache']['cache_name']));
                }
                if ($type == "entityManager") {
                    $db = EntityManager::create($conn_config
                        , $configuration, self::getContainer("eventManager"));
                } else if ($type == "Connection") {
                    $db = DriverManager::getConnection($conn_config
                        , $configuration, self::getContainer("eventManager"));
                }
            }
            $container = Bootstrap::getApplication()->getContainer();
            $container["dataBase" . $type . $dbName] = $db;
        }
        return self::getContainer("dataBase" . $type . $dbName);
    }

    /**
     * 获取指定键的配置文件
     *
     * @author macro chen <macro_fengye@163.com>
     * @param string $key
     * @return mixed
     */
    public static function getConfig($key)
    {
        if (!self::getContainer('config')->get($key)) {
            writeLog('获取', [$key . '--不存在!', debug_backtrace()], APP_PATH . '/log/config.log', Logger::ERROR);
            return NULL;
        }
        return self::getContainer('config')->get($key);
    }

    /**
     * 添加自定义监听器
     *
     * @author macro chen <macro_fengye@163.com>
     * @param array $params
     * @throws \Exception
     * @return EventManager
     */
    public static function addEvent(array $params = [])
    {
        $event_manager = self::getContainer('doctrineEventManager');
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
                $db_eventManager = self::getDbInstanceEvm($value['type'], $value['dbName'])->getEventManager();
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
    public static function addSubscriber(array $params = [])
    {
        $event_manager = self::getContainer('doctrineEventManager');
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
                $db_eventManager = self::getDbInstanceEvm($value['type'], $value['dbName'])->getEventManager();
                $db_eventManager->addEventSubscriber(new $class_name($data));
                continue;
            }
            $event_manager->addEventSubscriber(new $class_name($data));
        }
        return $event_manager;
    }

    /**
     * 获取拥有命名空间的缓存实例
     *
     * @param $cache_type
     * @param array $params
     * @deprecated
     * @throws \Exception
     * @return mixed
     */
    public static function getCacheInstanceHaveNamespace($cache_type, array $params = [])
    {
        if (!isset($params['resource_id'])) {
            throw new \Exception('资源ID必须设置', 400);
        }
        $resource_id = $params['resource_id'];
        unset($params['resource_id']);
        $cache = CoreUtils::getContainer($cache_type . 'Cache', $params)->getOptions()->getResourceManager()->getResource($resource_id);
        return $cache;
    }

    /**
     * 获取指定组件名字的对象
     *
     * @param $component_name
     * @param array $param
     * @return mixed|null
     */
    public static function getContainer($component_name, $param = [])
    {
        if (!Bootstrap::getApplication()->getContainer()->has($component_name)) {
            $class_name = '';
            if (!defined('SERVICE_NAMESPACE')) define('SERVICE_NAMESPACE', APP_NAME);
            if (class_exists(SERVICE_NAMESPACE . '\\Service\\' . ucfirst($component_name) . "Service")) {
                $class_name = SERVICE_NAMESPACE . '\\Service\\' . ucfirst($component_name) . "Service";
            } else if (class_exists('Core\\ServiceProvider\\' . ucfirst($component_name) . "Service")) {
                $class_name = 'Core\\ServiceProvider\\' . ucfirst($component_name) . "Service";
            }
            if ($class_name) Bootstrap::getApplication()->getContainer()->register(new $class_name(), $param);
        }
        if (Bootstrap::getApplication()->getContainer()->has($component_name)) {
            return Bootstrap::getApplication()->getContainer()->get($component_name);
        }
        return null;
    }
}