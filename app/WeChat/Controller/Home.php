<?php
namespace WeChat\Controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        print_r(weChatConfig());
        return $response->write('Hello ,Polymerssss!');
    }
}
