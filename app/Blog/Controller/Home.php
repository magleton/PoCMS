<?php
namespace Blog\Controller;

use Core\Controller\Controller;
use Core\Utils\CoreUtils;
use Blog\Models\Employee;
use Core\Utils\SnowFlake;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Sharding\ShardManager;
use Entity\Models\Eorder;
use Entity\Models\Region;
use Entity\Models\Test;


class Home extends Controller
{

    public function index($request, $response, $args)
    {
        $em = CoreUtils::getDbInstance('db1');
        echo SnowFlake::generateID();
        //print_r(CoreUtils::getContainer('current_database'));
        $em->getConnection()->connect(1);
        $r = $em->getConnection()->query('select * from address WHERE id=89584885122377')->fetch();
        print_r($r);
        //print_r($em->getConnection()->query('SELECT @@server_id as server_id LIMIT 1')->fetch());
        //$e = $em->find('Entity\Models\Person' , 2);
        /*$employee = new Employee();
        $employee->setName('macro');
        $employee->setPosition('11111');
        $employee->setSalary('1111');
        $error = CoreUtils::getContainer('validator')->validate($employee);
        $user_id = 0;
        if(!count($error)) {
            $em->persist($employee);
            $em->flush();
        }else{
            print_r($error);die();
        }
        echo $employee->getId();
        $e = $em->find('Entity\Models\Person' , $employee->getId());
        print_r($e);*/
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


    public function test($request, $response, $args)
    {
        /* @var $eventDispatcher EventDispatcherInterface */
        $eventDispatcher = $this->getContainer('event_dispatcher');
        /* @var $eventEmittingService EventEmittingService */
        $eventEmittingService = $this->getContainer('event_emitting_service');
        $eventEmittingService->emit();

        print_r(get_class_methods($this->getContainer('event_dispatcher')));
    }
}