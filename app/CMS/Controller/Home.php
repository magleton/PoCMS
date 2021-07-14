<?php

namespace CMS\Controller;

use Bernard\Message\DefaultMessage;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home extends Controller
{
    /**
     * @throws \Noodlehaus\Exception\EmptyDirectoryException
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $this->application->getConfig('britton.username');
        return $this->withJson($this->application->getConfig('britton.username'), $response);
    }

    public function hello(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        debugger();
        $this->render('/home/hello.twig', array(
            'name' => 'Macro',
        ));
    }

    /**
     * 消息队列
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     */
    public function producer(Request $request, Response $response, $args)
    {
        $producer = $this->application->component('mq_producer');
        $ret = $producer->produce(new DefaultMessage('EchoTime', [
            'time' => time(),
        ]), 'EchoTime');
    }
}