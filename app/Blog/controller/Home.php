<?php
namespace Blog\controller;

class Home extends \Controller\Controller
{

    public function index($request , $response , $args)
    {
        $this->consoleDebug(self::LOG , 'tips' , ['name'=>'jack']);
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