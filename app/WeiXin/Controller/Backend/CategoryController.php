<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Doctrine\ORM\ORMException;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WeiXin\Dto\CategoryDto;
use WeiXin\Dto\SearchDto;
use WeiXin\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * @Inject
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * 新增分类
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $categoryDto = CategoryDto::make($request->getParsedBody());
        $id = $this->categoryService->save($categoryDto);
        return $this->withJson(['id' => $id], $response);
    }

    /**
     * 修改分类
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $categoryDto = CategoryDto::make($request->getParsedBody());
        $id = $this->categoryService->update($categoryDto);
        return $this->withJson(['id' => $id], $response);
    }

    /**
     * 分类列表
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function list(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $searchDto = SearchDto::make($request->getParsedBody());
        $list = $this->categoryService->list($searchDto);
        return $this->withJson($list, $response);
    }

    /**
     * 分类详情
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function detail(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $id = $args['id'];
        $data = $this->categoryService->detail($id);
        return $this->withJson($data, $response);
    }

}