<?php
namespace Blog\controller;

class Home extends \Controller\Controller
{

    public function index($request, $response, $args)
    {
        $this->consoleDebug(self::LOG, 'tips', ['name' => 'jack']);
        $this->sessionContainer->user = array("username" => 20, "age" => 30);
        $this->render($response, '/home/index.twig', array(
            'somevar' => date('c'),
        ));
    }

    public function hello($request, $response, $args)
    {
        $event = $this->addEvent(self::ENTITY, 'db1', 'event_namespace', 'Events::prePersist');
        $em = $this->getDbInstance(self::ENTITY, 'db1');
        // print_r(get_class_methods($event));
        /*$this->render($response, "/home/hello.twig", array(
            'name' => 'Macro',
        ));*/
    }
}