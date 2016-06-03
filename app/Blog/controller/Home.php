<?php
namespace Blog\controller;

class Home extends \Controller\Controller
{

    public function index($request , $response , $args)
    {echo "This is Blog...";
        $this->sessionContainer->user = array("username"=>20 , "age"=>30);
        $this->render($response , '/home/index.twig', array(
            'somevar' => date('c'),
        ));
    }

    public function hello()
    {
        $this->render("/home/hello.twig", array(
            'name' => 'Macro',
        ));
    }
}