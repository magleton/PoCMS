<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use JsonException;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Dto\AdminDto;
use WeiXin\Services\AdminService;

class AdminController extends Controller
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
     * @throws JsonException
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $adminDto = AdminDto::make($request->getParsedBody());
        $token = $this->adminService->login($adminDto);
        return $this->withJson(['token' => $token], $response);
    }

    /**
     * 通过token获取管理员信息
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function getAdminInfo(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $token = $request->getQueryParams()['token'];
        $adminDto = AdminDto::make(['token' => $token]);
        $adminInfo = $this->adminService->getAdminInfo($adminDto);
        $adminInfo['roles'] = ['admin', 'manager'];
        $adminInfo['avatar'] = '头像地址';
        $adminInfo['introduction'] = '介绍';
        $adminInfo['name'] = 'Super Admin';
        return $this->withJson($adminInfo, $response);
    }

    public function test(ServerRequestInterface $request, ResponseInterface $response, $args):ResponseInterface{
        return $this->withJson('Hell' , $response);
    }
}