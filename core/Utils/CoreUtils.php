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
    private static function databaseConnection($type, $dbName)
    {
        //$dbConfig = self::getConfig('db')[APPLICATION_ENV];
        $dbConfig = self::getConfig('db')[APPLICATION_ENV];
        $db = NULL;
        if (isset($dbConfig[$dbName]) && $dbConfig[$dbName]) {
            $conn_config = $dbConfig[$dbName] ? $dbConfig[$dbName] : [];
            $useSimpleAnnotationReader = $conn_config['useSimpleAnnotationReader'];
            unset($conn_config['useSimpleAnnotationReader']);
            if ($useSimpleAnnotationReader) {
                $configuration = Setup::createConfiguration(APPLICATION_ENV == 'development');
                $configuration->setMetadataCacheImpl(self::getContainer(self::getConfig('customer')['doctrine_metadata_cache']['cache_name']));
                $annotationDriver = new AnnotationDriver(new AnnotationReader(), ROOT_PATH . "/entity/Models");
                AnnotationRegistry::registerLoader("class_exists");
                $configuration->setMetadataDriverImpl($annotationDriver);
            } else {
                $configuration = Setup::createAnnotationMetadataConfiguration(array(
                    ROOT_PATH . '/entity/Models',
                ), APPLICATION_ENV == 'development', ROOT_PATH . '/entity/Proxies/', self::getContainer(self::getConfig('customer')['doctrine_metadata_cache']['cache_name']), $useSimpleAnnotationReader);
            }
            if (APPLICATION_ENV == "development") {
                $configuration->setAutoGenerateProxyClasses(true);
            } else {
                $configuration->setAutoGenerateProxyClasses(true);
            }
            //设置缓存组件
            if (self::getConfig('customer')['doctrine_query_cache']['is_open']) {
                $configuration->setQueryCacheImpl(self::getContainer(self::getConfig('customer')['doctrine_query_cache']['cache_name']));
            }
            if (self::getConfig('customer')['doctrine_result_cache']['is_open']) {
                $configuration->setResultCacheImpl(self::getContainer(self::getConfig('customer')['doctrine_result_cache']['cache_name']));
            }
            if ($type == "entityManager") {
                $db = EntityManager::create($conn_config
                    , $configuration, self::getContainer("eventManager"));
            } else if ($type == "Connection") {
                $db = DriverManager::getConnection($conn_config
                    , $configuration, self::getContainer("eventManager"));
            }
        }
        if (!self::getContainer("dataBase" . $type . $dbName)) {
            Bootstrap::getAppContainer()["dataBase" . $type . $dbName] = $db;
        }
        return $db;
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
            writeLog('base_config', [$key . '--不存在!'], APP_PATH . '/log/config.log', Logger::ERROR);
            return NULL;
        }
        return self::getContainer('config')->get($key);
    }

    /**
     * 添加自定义监听器
     *
     * @author macro chen <macro_fengye@163.com>
     * @param $db_type
     * @param $db_name
     * @param $namespace
     * @param $event_name
     * @param $data
     * @return EventManager
     */
    public static function addEvent($db_type, $db_name, $namespace, $event_name, $data = null)
    {
        $event_manager = self::getDbInstanceEvm($db_type, $db_name);
        if (self::getConfig($namespace)) {
            if (is_array($event_name)) {
                $events = [];
                foreach ($event_name as $k => $v) {
                    $class_name = self::getConfig($namespace)[$v];
                    if ($class_name) {
                        $events[$class_name][] = $v;
                    }
                }
                foreach ($events as $kk => $vv) {
                    $event_manager->addEventListener($vv, new $kk($data));
                }
            } else {
                $class_name = self::getConfig($namespace)[$event_name];
                if ($class_name) {
                    $event_manager->addEventListener([$event_name], new $class_name($data));
                }
            }
        }
        return $event_manager;
    }


    /**
     * 添加自定义订阅器
     *
     * @author macro chen <macro_fengye@163.com>
     * @param $db_type
     * @param $db_name
     * @param $namespace
     * @param $subscriber_name
     * @return EventManager
     */
    public static function addSubscriber($db_type, $db_name, $namespace, $subscriber_name)
    {
        $event_manager = self::getDbInstanceEvm($db_type, $db_name);
        if (self::getConfig($namespace)) {
            if (isset(self::getConfig($namespace)[$subscriber_name])) {
                $class_name = self::getConfig($namespace)[$subscriber_name];
                $event_manager->addEventSubscriber(new $class_name());
            }
        }
        return $event_manager;
    }

    /**
     * 获取指定数据库实例的事件组件
     *
     * @author macro chen <macro_fengye@163.com>
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == Connection 支持分库分表
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
     *
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
     *
     * @author macro chen <macro_fengye@163.com>
     * @param string $type 缓存的类型
     * @param string $server_name 服务器的名字
     * @param bool $lookup 是否继续寻找其他的服务器是否可以链接
     * @return mixed
     */
    public static function getCacheInstance($type, $server_name, $lookup = true)
    {
        $config = self::getConfig('cache');
        $cache_obj = NULL;
        if ($config && isset($config[$type])) {
            switch ($type) {
                case self::REDIS:
                    $cache_obj = new \Redis();
                    $is_conn = $cache_obj->connect($config[$type][$server_name]['host'], $config[$type][$server_name]['port'], $config[$type][$server_name]['timeout']);
                    if (!$is_conn && $lookup) {
                        foreach ($config[$type] as $key => $value) {
                            if ($key != $server_name) {
                                $is_conn = $cache_obj->connect($value['host'], $value['port'], $value['timeout']);
                                if ($is_conn) {
                                    break;
                                }
                            }
                        }
                    }
                    break;
                case self::MEMCACHE:
                    $cache_obj = new \Memcache();
                    $is_conn = $cache_obj->connect($config[$type][$server_name]['host'], $config[$type][$server_name]['port'], $config[$type][$server_name]['timeout']);
                    if (!$is_conn && $lookup) {
                        foreach ($config->$type as $key => $value) {
                            if ($key != $server_name) {
                                $is_conn = $cache_obj->connect($value['host'], $value['port'], $value['timeout']);
                                if ($is_conn) {
                                    break;
                                }
                            }
                        }
                    }
                    break;
                case self::MEMCACHED:
                    $cache_obj = new \Memcached();
                    $is_conn = $cache_obj->addServer($config[$type][$server_name]['host'], $config[$type][$server_name]['port'], $config[$type][$server_name]['weight']);
                    if (!$is_conn && $lookup) {
                        foreach ($config->$type as $key => $value) {
                            if ($key != $server_name) {
                                $is_conn = $cache_obj->addServer($value['host'], $value['port'], $value['weight']);
                                if ($is_conn) {
                                    break;
                                }
                            }
                        }
                    }
                    break;
                default:
                    break;
            }
        }
        return $cache_obj;
    }

    /**
     * 获取指定组件名字的对象
     *
     * @param $componentName
     * @return mixed
     */
    public static function getContainer($componentName)
    {
        if (!Bootstrap::getApplication()->getContainer()->has($componentName)) {
            writeLog('debug' , [$componentName]);
            if (!defined('SERVICE_NAMESPACE')) define('SERVICE_NAMESPACE', APP_NAME);
            if (class_exists(SERVICE_NAMESPACE . '\\Service\\' . ucfirst($componentName) . "Service")) {
                $class_name = SERVICE_NAMESPACE . '\\Service\\' . ucfirst($componentName) . "Service";
            } else if (class_exists('Core\\ServiceProvider\\' . ucfirst($componentName) . "Service")) {
                $class_name = 'Core\\ServiceProvider\\' . ucfirst($componentName) . "Service";
            }
            Bootstrap::getApplication()->getContainer()->register(new $class_name());
        }
        if (Bootstrap::getApplication()->getContainer()->has($componentName)) {
            return Bootstrap::getApplication()->getContainer()->get($componentName);
        }
        return null;
    }
}