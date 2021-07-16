<?php

namespace WeiXin\Controller\Backend;

use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BannerController extends Controller
{
    /**
     * Banner列表
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function bannerList(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        return [];
    }
}