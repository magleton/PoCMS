<?php

namespace CMS\Controller;

use Bernard\Message\DefaultMessage;
use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        return $this->withJson(['data' => 'data']);
    }

    public function hello(Request $request, Response $response, $args)
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
        $producer = $this->app->component('mq_producer');
        $ret = $producer->produce(new DefaultMessage('EchoTime', [
            'time' => time(),
        ]), 'EchoTime');
    }
}