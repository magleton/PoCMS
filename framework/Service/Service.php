<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 17-2-17
 * Time: 下午1:13
 */

namespace Polymer\Service;

use Polymer\Boot\Application;
use Slim\Http\Request;

class Service
{
    /**
     * 请求对象
     *
     * @var Request
     */
    protected $request;

    /**
     * 全局应用
     *
     * @var Application
     */
    protected $app;

    /**
     * SendMsgService constructor.
     *
     * @param Request|null $request
     * @param Application|null $app
     */

    public function __construct(Request $request = null, Application $app = null)
    {
        $this->request = $request ?: app()->component('request');
        $this->app = $app ?: app();
    }
}