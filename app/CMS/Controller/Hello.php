<?php
namespace CMS\controller;

use Doctrine\Common\Cache\MemcacheCache;
use Doctrine\ORM\Query\ResultSetMapping;

use Boot\Bootstrap;
use Doctrine\Common\EventArgs;
use CMS\Entity\Actor;
use CMS\event\TestEvent;
use CMS\subscriber\TestEventSubscriber;
use Zend\Permissions\Rbac\Rbac;
use Zend\Validator\EmailAddress;

class Hello extends \Controller\Controller
{

    protected $hooks = array(
        "the.hook.name" => array(
            array(),
        ),
        "slim.after.dispatch" => array(array("black", "red")),
    );

    protected function registerHooks()
    {
        foreach ($this->hooks as $key => $val) {
            $this->app->hook($key, function () use ($val) {
                $data['name'] = "jack";
                echo $data['name'];
                echo "registerHooks";
            });
        }
    }

    public function index()
    {
        $this->sessionContainer->pageNum11 = 10;
        $validator = new EmailAddress();
        $name = array(
            'name' => "macro",
        );
        $this->applyHook("the.hook.name", $name);
        $this->render('/home/index.twig', array(
            'somevar' => $name['name'],
        ));
        $eventArgs = new EventArgs();
        $eventArgs->obj = array(1, 2, 3, 4, 5, 6);
        // $testEvent = new TestEvent(Bootstrap::getEntityManager()->getEventManager());
        $eventSubscriber = new TestEventSubscriber();
        $test = new TestEvent(Bootstrap::getEvm("db1"));
        $test->preFoo($eventArgs);
        Bootstrap::getEvm("db1")->addEventSubscriber($eventSubscriber);
        Bootstrap::getEvm("db1")->dispatchEvent(TestEvent::preFoo, $eventArgs);
        //   print_r(Bootstrap::getEvm()->getListeners());
    }

    public function show()
    {
        /*
        $client = new Client();
        $response = $client->get("http://guzzlephp.org"); */
        $this->sessionContainer->pageNum = 10;
        $this->sessionContainer->limit = "Macro chen";
        $this->sessionContainer->parans = "AAAAAAAAa";
        echo $this->sessionContainer->parans;
        print_r($this->param('name'));
    }

    public function test()
    {
        print_r($this->app->router()
            ->getCurrentRoute()
            ->getParams());
        print_r($this->sessionContainer->pageNum);
    }

    public function addItem()
    {
        $this->app->applyHook('aaa');
        print_r(get_class_methods($this->app));
        $em = $this->getPimple("entityManager");
        /* $conn = $em->getConnection(); */
        $actor = new Actor();
        $actor->setFirstName('macro');
        $actor->setLastName("bbbddddddd");
        $eventArgs = new EventArgs();
        $eventArgs->obj = $actor;
        // $testEvent = new TestEvent(Bootstrap::getEntityManager()->getEventManager());
        $eventSubscriber = new TestEventSubscriber();
        $this->getPimple("eventManager")->addEventSubscriber($eventSubscriber);
        $this->getPimple("eventManager")->dispatchEvent(TestEvent::preFoo, $eventArgs);

        $em->persist($actor);
        $em->flush($actor);

        /*
         * $metadata = $em->getClassMetadata(get_class($actor));
         * $tableName = $metadata->getQuotedTableName($conn);
         * echo $tableName;
         * print_r($metadata->getTableName());
         * $results = $conn->query("select * from " . $tableName);
         * print_r($metadata->getAssociationMappings());
         */
        /*
     * $actor->setFirstName("zhao");
     * $actor->setLastName("haha");
     * $em->persist($actor);
     * $em->flush($actor );
     */
    }

    public function getItems()
    {
        $em = $this->getDbInstance(self::ENTITY, "db1");
        $query = $em->createQuery('SELECT u FROM Blog\Entity\Actor u WHERE u.actor_id = ?1');
        $query->setParameter(1, 1);
        $query->setResultCacheDriver($this->getPimple("redisCacheDriver"));
        $query->useResultCache(true)
            ->setResultCacheLifeTime($seconds = 3600);
        //$result = $query->getResult(); // cache miss
        //$query->expireResultCache(true);
        //$result = $query->getResult(); // forced expire, cache miss
        //$query->setResultCacheId('aaaaaaa');
        $result = $query->getResult(); // saved in given result cache id.
        $redis = $this->getPimple("redisCache");
       foreach ($result as $value){
           print_r($value->getLastName());
       }
        $redis->setItem("key1" , "Key Key...");
        $redis->setItem("key2" , "sdadadasd");
        echo $redis->getItem("key1");

        $this->getPimple("serviceManager");
        return;
// or call useResultCache() with all parameters:
        $query->useResultCache(true, $seconds = 3600, 'my_query_result');
        $result = $query->getResult(); // cache hit!

// Introspection
        $queryCacheProfile = $query->getQueryCacheProfile();
        $cacheDriver = $query->getResultCacheDriver();
        $lifetime = $query->getLifetime();


    }

    public function admin()
    {
        if ($this->app->response->getStatus() == 404) {
            check_login();
        }
    }

    public function rbac()
    {
        $rbac = new Rbac();
        $rbac->addRole("foo");
        var_dump($rbac->hasRole('foo'));
        echo "rbac";
    }

    public function rbac1()
    {
        print_r($this->params);
        echo "rbac1";
    }

    public function login()
    {
        echo "Login....";
    }

    /**测试SessionContainer**/
    public function setsession()
    {
        var_dump($this->sessionContainer->user);
        $this->sessionContainer->name = "macro oop";
    }

    public function getsession()
    {
        echo $this->sessionContainer->name;
    }
}