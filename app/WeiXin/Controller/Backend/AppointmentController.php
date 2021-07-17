<?php


namespace WeiXin\Controller\Backend;


use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Services\AdminService;

class AppointmentController extends Controller
{
    /**
     * @Inject
     * @var AdminService
     */
    private AdminService $adminService;

    /**
     * 管理员登录
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $test = $this->adminService->test();
        $response->getBody()->write($test);
        return $response;
    }
}