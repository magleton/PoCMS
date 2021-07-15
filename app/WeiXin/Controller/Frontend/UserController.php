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
        $contentType = $request->getHeaderLine('Content-Type');

        if (strstr($contentType, 'application/json')) {
            $contents = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            }
        }
        $userLoginDto = new UserLoginDto($request->getParsedBody());
        $token = $this->userService->login($userLoginDto);
        $response->getBody()->write($token);
        return $response;
    }
}