<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/18
 * Time: 21:36
 */

namespace Task\Boot;

use Core\Boot\Application;

class BootTask
{
    const ENTITY = "entityManager";
    const REDIS = "redis";
    const MEMCACHE = "memcache";
    const MEMCACHED = 'memcached';

    /**
     * 整个框架的应用
     * @var \Core\Boot\Application
     */
    protected $app;

    public function __construct()
    {
        $this->app = new Application();
        $this->app->startConsole();
    }
}