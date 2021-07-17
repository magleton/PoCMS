<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Polymer\Controller\Controller;
use Polymer\Tests\Services\OrderService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OrderController extends Controller
{
    /**
     * @Inject
     * @var OrderService
     */
    private OrderService $orderService;

    /**
     * 管理员登录
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $test = $this->orderService->test();
        $response->getBody()->write($test);
        return $response;
    }
}