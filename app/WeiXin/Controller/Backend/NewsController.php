<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Doctrine\ORM\ORMException;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Dto\BannerDto;
use WeiXin\Dto\NewsDto;
use WeiXin\Services\NewsService;

class NewsController extends Controller
{
    /**
     * @Inject
     * @var NewsService
     */
    private NewsService $newsService;

    /**
     * 新增新闻
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $newsDto = NewsDto::make($request->getParsedBody());
        $this->newsService->save($newsDto);
        return $response;
    }

    /**
     * 修改新闻
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
        $this->newsService->update($bannerDto);
        return $response;
    }

    /**
     * 新闻列表
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
        $this->newsService->list($bannerDto);
        return $response;
    }

    /**
     * 新闻详情
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function detail(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $id = $args['id'];
        $data = $this->newsService->detail($id);
        return $this->withJson($data, $response);
    }

}