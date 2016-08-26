<?php
namespace CMS\controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Home extends \Controller\Controller
{

    public function index(Request $request, Response $response, $args)
    {
        echo haha();
        $this->sessionContainer->user = array("username" => 20, "age" => 30);
        $this->render($response, '/home/index.twig', array(
            'somevar' => date('c'),
        ));
    }

    public function hello(Request $request, Response $response, $args)
    {
        $this->render($response, "/home/hello.twig", array(
            'name' => 'Macro',
        ));
    }
}