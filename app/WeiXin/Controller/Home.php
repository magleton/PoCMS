<?php

namespace WeiXin\Controller;

use Exception;
use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\UsersBureaus;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args): void
    {
        //$model = $this->app->model('test', [], 'WeiXin\\Models');
        // $model->save($request->getParams());
        $model = $this->app->model('user', [], 'WeiXin\\Models');
        $model->getList();
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
        } catch (Exception $e) {
            //处理用户48小时没有与公众号互动
        }
    }
}
