<?php
namespace Core\Boot;


use Core\Utils\CoreUtils;


final class Bootstrap
{
    /**
     * 引导WEB应用
     *
     * @author macro chen <macro_fengye@163.com>
     */
    public function start()
    {
        try {
            $core = new CoreUtils();
            $core->startApp();
            //CoreUtils::startApp();
            $core->getContainer('routerFile');
            $core->getContainer('app')->run();
        } catch (\Exception $e) {
            echo \GuzzleHttp\json_encode(['code' => 1000, 'msg' => $e->getMessage(), 'data' => []]);
            return false;
        }
        if ($core->getConfig('customer')['show_use_memory']) {
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
        CoreUtils::startApp();
    }
}