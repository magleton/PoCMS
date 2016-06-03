<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-4-29
 * Time: 上午10:48
 */

namespace Boot;

use Doctrine\DBAL\Sharding\PoolingShardManager;

class Base
{
    /**
     * 整个应用
     *
     * @author macro chen <macro_fengye@163.com>
     * @var Slim APP $app
     */
    protected $app;

    /**
     * 获取应用的SessionManager
     *
     * @author macro chen <macro_fengye@163.com>
     * @var SessionManager $sessionManager
     */
    protected $sessionManager;

    /**
     * 获取应用的SessionContainer
     *
     * @author macro chen <macro_fengye@163.com>
     * @var SessionContainer $sessionContainer
     */
    protected $sessionContainer;

    /**
     * 数据库链接类型
     * @author macro chen <macro_fengye@163.com>
     * @var SessionContainer $sessionContainer
     */
    const ENTITY = "entityManager";
    const CONNECTION = "Connection";

    /**
     * 缓存的类型
     */
    const REDIS = "redis";
    const MEMCACHE = "memcache";

    /**
     * 控制器构造函数
     *
     * @author macro chen <macro_fengye@163.com>
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * 获取指定组件名字的对象
     * @param $componentName
     * @return mixed
     */
    protected function getContainer($componentName)
    {
        return Bootstrap::getContainer($componentName);
    }

    /**
     * 获取数据库的实例
     * @author macro chen <macro_fengye@163.com>
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == driverManager支持分库分表
     * @param string $dbName 数据库配置的键名
     * @return \Doctrine\Common\EventManager
     */
    protected function getDbInstance($type, $dbName)
    {
        return Bootstrap::getDbInstance($type, $dbName);
    }

    /**
     * 缓存对象的实例
     * @author macro chen <macro_fengye@163.com>
     * @param $type 缓存的类型
     * @param string $server_name 服务器的名字
     * @param bool $lookup 是否继续寻找其他的服务器是否可以链接
     * @return mixed
     */
    protected function getCacheInstance($type, $server_name, $lookup = true)
    {
        return Bootstrap::getCacheInstance($type, $server_name, $lookup);
    }

    /**
     * 获取指定数据库实例的事件组件
     * @author macro chen <macro_fengye@163.com>
     * @param $type
     * $type == entityManager的实例可以支持事务
     * $type == driverManager支持分库分表
     * @param string $dbName
     * @param string $dbName
     * @return \Doctrine\Common\EventManager
     */
    protected function getDbInstanceEvm($type, $dbName)
    {
        return Bootstrap::getDbInstanceEvm($type, $dbName);
    }

    /**
     * 获取应用的配置
     * @author macro chen <macro_fengye@163.com>
     * @param $key 响应的对象
     * @return \Zend\Config\Config
     */
    protected function getConfig($key)
    {
        return Bootstrap::getConfig($key);
    }

    /**
     * 获取分库分表的管理器,当getDbInstance的type==driverManager方可使用
     * @param string \Doctrine\ORM\EntityManager $em
     * @param integer $shard_id 分库的ID
     * @return \Doctrine\DBAL\Sharding\PoolingShardManager $shardManager
     */
    protected function getConnection($em, $shard_id)
    {
        $qb = $em->createQueryBuilder();
        $conn = $qb->getConnection();
        $shardManager = new PoolingShardManager($conn);
        $shardManager->selectGlobal();
        $shardManager->selectShard($shard_id);
        return $shardManager;
    }
}