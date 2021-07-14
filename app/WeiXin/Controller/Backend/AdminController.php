<?php


namespace WeiXin\Controller\Backend;


use DI\Annotation\Inject;
use DI\Bridge\Slim\ControllerInvoker;
use Polymer\Service\MyTestService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Services\AdminService;

class AdminController extends ControllerInvoker
{
    /**
     * @Inject
     * @var AdminService
     */
    private AdminService $adminService;

    public function test(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $test = $this->adminService->test();
        $response->getBody()->write($test);
        return $response;
    }
}