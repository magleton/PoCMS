<?php

namespace WeiXin\Controller\Backend;

use DI\Annotation\Inject;
use Doctrine\ORM\ORMException;
use Exception;
use Polymer\Controller\Controller;
use Polymer\Utils\FuncUtils;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use WeiXin\Dto\OrdersDto;
use WeiXin\Services\OrdersService;

class OrderController extends Controller
{
    /**
     * @Inject
     * @var OrdersService
     */
    private OrdersService $ordersService;

    /**
     * 新增分类
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws ORMException|Exception
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $orderDto = OrdersDto::make($request->getParsedBody());
        $orderDto['orderNo'] = FuncUtils::generateSalt(12);
        $orderDto['status'] = 0;
        $id = $this->ordersService->save($orderDto);
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
        $categoryDto = OrdersDto::make($request->getParsedBody());
        $id = $this->ordersService->update($categoryDto);
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
        $searchDto = OrdersDto::make($request->getParsedBody());
        $list = $this->ordersService->list($searchDto);
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
        $data = $this->ordersService->detail($id);
        return $this->withJson($data, $response);
    }
}