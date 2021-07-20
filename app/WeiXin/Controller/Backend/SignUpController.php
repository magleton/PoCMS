<?php


namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Services\AdminService;

class SignUpController extends Controller
{
    /**
     * @Inject
     * @var SignupService
     */
    private SignupService $signupService;

    /**
     * 管理员登录
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $test = $this->signupService->test();
        $response->getBody()->write($test);
        return $response;
    }
}

{

}