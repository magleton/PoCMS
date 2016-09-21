<?php
namespace Core\Utils;

use Core\Boot\Application;
use Doctrine\Common\EventManager;

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
        return app()->getDbInstance($type, $dbName);
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
        return app()->getConfig($key);
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
        return app()->addEvent($params);
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
        return app()->addSubscriber($params);
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
    public static function getCacheInstanceHaveNamespace($cache_type, array $params = [])
    {
        return app()->getCacheInstanceHaveNamespace($cache_type, $params);
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
        return app()->getContainer($component_name, $param);
    }

    /**
     * 获取应用实例
     *
     * @author macro chen <macro_fengye@163.com>
     * @return static
     */
    public static function getApplication()
    {
        return Application::getInstance();
    }
}