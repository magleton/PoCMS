<?php
namespace Blog\Controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        return $response->write('Hello ,Polymer!');
    }
}