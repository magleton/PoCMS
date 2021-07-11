<?php

namespace WeiXin\Controller;

use DI\Annotation\Inject;
use EasyWeChat\Kernel\Messages\Text;
use Exception;
use Polymer\Controller\Controller;
use Polymer\Providers\BizValidatorProvider;
use Polymer\Providers\LoggerProvider;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Entity\Mapping\User;
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

    public function index(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
//        /$sss = $this->application->service('hello', null, $this->application->service('test'));
        //$model = $this->app->model('test', [], 'WeiXin\\Models');
        // $model->save($request->getParams());
        //$model = $this->getApplication()->model('user', [], 'WeiXin\\Models');
        // print_r($this->application->get('request'));
        $this->application->get(LoggerProvider::class)->info("aaaaaa枫叶思源");
        $list = $this->helloService->getList();
        return $this->withJson(["aaa" => 'hello' . $this->diContainer->get('username'), 'str' => $this->str, 'kkk' => $this->helloService->hello()], $response);
    }

    /**
     * 发送消息
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     */
    public function send(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        try {
            $staff = $this->application->get('staff');
            $message = new Text(['content' => 'Hello world!']);
            $result = $staff->message($message)->to('ok7_ewvHECzfFfI3ndtw4cCU6dF4')->send();
        } catch (Exception $e) {
            //处理用户48小时没有与公众号互动
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     */
    public function addUser(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
       $this->helloService->save(['phone'=>'111111','username'=>'a']);
        return  $this->withJson(['userame'=>'britton'], $response);
    }
}
