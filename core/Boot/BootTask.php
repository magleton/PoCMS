<?php
namespace Boot;

class BootTask extends Base
{
    /**
     * 初始化函数
     *
     * @author macro chen <macro_fengye@163.com>
     */
    protected function init()
    {
        $this->app = Bootstrap::getApp();
        $this->sessionManager = Bootstrap::getContainer('sessionManager');
        $this->sessionContainer = Bootstrap::getContainer('sessionContainer');
    }
}