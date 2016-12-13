<?php
namespace Blog\Subscriber;

use Doctrine\Common\EventSubscriber;
use Blog\event\TestEvent;
use Boot\Bootstrap;
use Respect\Validation\Validator;

class TestEventSubscriber implements EventSubscriber
{

    public $preFooInvoked = false;

    public function getSubscribedEvents()
    {
        return array(
            TestEvent::preFoo
        );
    }

    public function preFoo($args)
    {
        print_r($args);
        echo "adadsdad";
    }
}

?>