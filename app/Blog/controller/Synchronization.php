<?php
namespace Blog\controller;

use Controller\Controller;
use Slim\Http\Request;


class Synchronization extends Controller
{
    public function test($request, $response, $args)
    {
        print_r(get_class_methods($this->getContainer(('lazy_service_factory'))));
        $kk = $this->getContainer('memcacheCacheDriver');
        print_r(($kk));
    }
}