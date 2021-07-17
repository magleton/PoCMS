<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Doctrine\ORM\ORMException;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Dto\BannerDto;
use WeiXin\Services\BannerService;

class BannerController extends Controller
{
    /**
     * @Inject
     * @var BannerService
     */
    private BannerService $bannerService;

    /**
     * 新增Banner
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $bannerDto = BannerDto::make($request->getParsedBody());
        $this->bannerService->save($bannerDto);
        return $response;
    }

    /**
     * 修改Banner
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $bannerDto = BannerDto::make($request->getParsedBody());
        $this->bannerService->update($bannerDto);
        return $response;
    }

    /**
     * Banner列表
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException
     */
    public function list(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $bannerDto = BannerDto::make($request->getParsedBody());
        $this->bannerService->list($bannerDto);
        return $response;
    }
}