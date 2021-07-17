<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Services\BannerService;

class BannerController extends Controller
{
    /**
     * @Inject
     * @var BannerService
     */
    private BannerService $bannerService;

    /**
     * Banner列表
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $this->bannerService->add();
        return $response;
    }
}