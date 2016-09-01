<?php
namespace Blog\controller;

use Core\Controller\Controller;
use Core\Utils\CoreUtils;

class Home extends Controller
{

    public function index($request, $response, $args)
    {
        /*$this->consoleDebug(self::LOG, 'tips', ['name' => 'jack']);
        CoreUtils::getContainer('sessionContainer')->user = array("username" => 20, "age" => 30);
        $abc = CoreUtils::getContainer('abc');*/
        /*$redis = CoreUtils::getCacheInstanceWithParams(CoreUtils::REDIS , ['server_name'=>'server1' , 'namespace'=>'abc']);
        $redis->set('aaa' , 'kkkk');*/
        $co = CoreUtils::getContainer('redisCacheDriver');
        print_r(get_class_methods($co));
        //$co->set('aaaa' , '0999');
       // $co->addItem('aaaa' , 'lllllllllll');
        //echo $co->getItem('aaaa');
        //print_r(get_class_methods($co->getOptions()->getResourceManager()->getResource('an')->hSet('gghf' , 'mmm' , 90)));
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


    public function test($request , $response , $args){
        /* @var $eventDispatcher EventDispatcherInterface */
        $eventDispatcher = $this->getContainer('event_dispatcher');
        /* @var $eventEmittingService EventEmittingService */
        $eventEmittingService = $this->getContainer('event_emitting_service');
        $eventEmittingService->emit();

        print_r(get_class_methods($this->getContainer('event_dispatcher')));
    }
}