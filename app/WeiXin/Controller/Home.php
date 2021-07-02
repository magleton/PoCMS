<?php

namespace WeiXin\Controller;

use Exception;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        //$model = $this->app->model('test', [], 'WeiXin\\Models');
        // $model->save($request->getParams());
        $model = $this->application->model('user', [], 'WeiXin\\Models');
        $list = $model->getList();
        return $this->withJson(["aaa" => 'hello'], $response);
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
            $staff = $this->application->component('staff');
            $message = new Text(['content' => 'Hello world!']);
            $result = $staff->message($message)->to('ok7_ewvHECzfFfI3ndtw4cCU6dF4')->send();
        } catch (Exception $e) {
            //处理用户48小时没有与公众号互动
        }
    }
}
