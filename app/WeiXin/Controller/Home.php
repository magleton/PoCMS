<?php
namespace WeiXin\Controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use WeChat\WeChat\Message\Text;
use WeChat\WeChat\Support\Collection;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $server = $this->app->component('server');
        $server->setMessageHandler(function (Collection $message) {
            logger(__FUNCTION__, [$message->toArray()], APP_PATH . '/log/debug.log');
            /*$handler = new Handler($message);
            return $handler->handle();*/
            return "您好！欢迎关注我!";
        });
        return $server->serve();
    }

    /**
     * 发送消息
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     */
    public function send(Request $request, Response $response, $args)
    {
        try {
            $staff = $this->app->component('staff');
            $message = new Text(['content' => 'Hello world!']);
            $result = $staff->message($message)->to('ok7_ewvHECzfFfI3ndtw4cCU6dF4')->send();
        } catch (\Exception $e) {
            //处理用户48小时没有与公众号互动
        }
    }
}
