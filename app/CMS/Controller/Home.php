<?php
namespace CMS\controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller
{

    public function index(Request $request, Response $response, $args)
    {
        return $this->withJson(['data'=>'ababab']);
    }

    public function hello(Request $request, Response $response, $args)
    {
        $this->render($response, "/home/hello.twig", array(
            'name' => 'Macro',
        ));
    }
}