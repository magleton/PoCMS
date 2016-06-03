<?php
namespace CMS\controller;

class Home extends \Controller\Controller
{

    public function index()
    {
        echo haha();
        $this->sessionContainer->user = array("username"=>20 , "age"=>30);
        $this->render('/home/index.twig', array(
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