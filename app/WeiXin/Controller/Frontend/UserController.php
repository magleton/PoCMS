<?php

namespace WeiXin\Controller\Frontend;

use DI\Annotation\Inject;
use JsonException;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Dto\UserLoginDto;
use WeiXin\Services\UserService;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    private UserService $userService;

    /**
     * @throws JsonException
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $userLoginDto = new UserLoginDto($request->getParsedBody());
        $token = $this->userService->login($userLoginDto);
        $response->getBody()->write($token);
        return $response;
    }
}