<?php

namespace WeiXin\Controller;

use DI\Annotation\Inject;
use Exception;
use Polymer\Controller\Controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Services\HelloService;

class Home extends Controller
{
    /**
     * @Inject(name="session_handler")
     */
    private array $str = ["adad"];

    /**
     * @var HelloService
     */
    private HelloService $helloService;

    public function __construct(ContainerInterface $ci, HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
//        /$sss = $this->application->service('hello', null, $this->application->service('test'));
        //$model = $this->app->model('test', [], 'WeiXin\\Models');
        // $model->save($request->getParams());
        $model = $this->getApplication()->model('user', [], 'WeiXin\\Models');
        $list = $model->getList();
        return $this->withJson(["aaa" => 'hello' . $this->diContainer->get('username'), 'str' => $this->str, 'kkk' => $this->helloService->hello()], $response);
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
            $staff = $this->getApplication()->component('staff');
            $message = new Text(['content' => 'Hello world!']);
            $result = $staff->message($message)->to('ok7_ewvHECzfFfI3ndtw4cCU6dF4')->send();
        } catch (Exception $e) {
            //处理用户48小时没有与公众号互动
        }
    }
}
