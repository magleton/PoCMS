<?php
namespace CMS\controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Hello extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        return $this->withJson(['data' => []]);
    }
}