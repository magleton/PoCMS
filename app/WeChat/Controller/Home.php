<?php
namespace WeChat\Controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use WeChat\WeChat\Support\Collection;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $server = $this->app->component('server');
        $server->setMessageHandler(function (Collection $message) {
            logger(__FUNCTION__, [$message->toArray()], APP_PATH . '/log/debug.log');
            /*$handler = new Handler($message);
            return $handler->handle();*/
        });
        return $server->serve();
    }
}
