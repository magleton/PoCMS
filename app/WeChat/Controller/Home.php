<?php
namespace Blog\Controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
echo mkdir(sys_get_temp_dir().'/abc');
        $obj = $this->app->component('abc' , [] , 'Captcha\\Providers');
        return $response->write('Hello ,Polymerssss!');
    }
}
