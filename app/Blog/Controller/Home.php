<?php
namespace Blog\Controller;

use Core\Boot\Application;
use Core\Controller\Controller;
use Core\Utils\CoreUtils;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Entity\Models\Region;
use Entity\Models\Test;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;




class Home extends Controller
{

    public function index($request, $response, $args)
    {
        $std = new \Blog\Models\Test();
        $std->setFirstName('aa');
        $validator = CoreUtils::getContainer('validator');
        print_r($validator->validate($std));
        die();
        //$conn = CoreUtils::getDbInstance(CoreUtils::CONNECTION , 'db1');
        /*if(get_class($em->getConnection()) == get_class($conn)){
            echo "aaaaa";
        }*/
        /*echo "hello";
        haha();
        print_r(CoreUtils::getConfig('customer'));
        CoreUtils::getContainer('session')->set('user_info' , ['user_id'=>123 , 'user_phone'=>'15887798765']);
        $redis = CoreUtils::getContainer('redis' , ['server_name'=>'server1']);
        print_r($redis->get('key2'));*/
        //$em = CoreUtils::getDbInstance(CoreUtils::ENTITY , 'db1');
        //$query = $em->createQuery('SELECT order_file FROM Entity\Models\OrderFile order_file');
        /*$this->consoleDebug(self::LOG, 'tips', ['name' => 'jack']);
        CoreUtils::getContainer('sessionContainer')->user = array("username" => 20, "age" => 30);
        $abc = CoreUtils::getContainer('abc');*/
        /*$redis = CoreUtils::getCacheInstanceWithParams(CoreUtils::REDIS , ['server_name'=>'server1' , 'namespace'=>'abc']);
        $redis->set('aaa' , 'kkkk');*/
        //$co = CoreUtils::getContainer('redisCacheDriver');
        //print_r(get_class_methods($co));
        //$co = CoreUtils::getContainer('redisCache' , ['server_name'=>'server2']);
        //$co = CoreUtils::getContainer('memcacheCacheDriver' , ['server_name'=>'server2','resource_id'=>2 , 'namespace'=>'abc']);
        $memcacheCache = app()->getContainer('memcache');
        //$memcacheCache->getMemcache()->set('name' , 'jerry');
        //$co->set('name' , 'macrochen');
        //$co->set('aaaa' , '0999');
       // $co->addItem('aaaa' , 'lllllllllll');
        //echo $co->getItem('aaaa');
        //print_r(get_class_methods($co->getOptions()->getResourceManager()->getResource('an')->hSet('gghf' , 'mmm' , 90)));
        /*$this->render($response, '/home/index.twig', array(
            'somevar' => date('c'),
        ));*/
    }

    public function hello($request, $response, $args)
    {
        /*$event = $this->addEvent(self::ENTITY, 'db1', 'event_namespace', 'Events::prePersist');
        $em = $this->getDbInstance(self::ENTITY, 'db1');*/
        // print_r(get_class_methods($event));
        /*$this->render($response, "/home/hello.twig", array(
            'name' => 'Macro',
        ));*/
        $se = CoreUtils::getContainer('session')->get('user_info');
        print_r($se);
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