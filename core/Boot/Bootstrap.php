<?php
namespace Core\Boot;

use Core\ServiceProvider\InitAppService;
use Core\Utils\CoreUtils;
use Slim\Container;

class Bootstrap
{
    private static $app = NULL;

    /**
     * 引导WEB应用
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
            register_shutdown_function('fatal_handler');
            $container = new Container();
            $container->register(new InitAppService());
            self::$app = $container['app'];
            CoreUtils::getContainer('routerFile');
            CoreUtils::getContainer('app')->run();
        } catch (\Exception $e) {
            echo \GuzzleHttp\json_encode(['code' => 1000, 'msg' => $e->getMessage(), 'data' => []]);
            return false;
        }
        if (CoreUtils::getConfig('config')['customer']['show_use_memory']) {
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
    public static function startConsole()
    {
        if (APPLICATION_ENV == 'production') {
            if (!ini_get('display_errors')) {
                ini_set('display_errors', 'off');
            }
            error_reporting(0);
        }
        $container = new Container();
        $container->register(new InitAppService());
        self::$app = $container['app'];
    }

    /**
     * 获取Slim APP
     * @return \Slim\APP
     */
    public static function getApplication()
    {
        return self::$app;
    }
}