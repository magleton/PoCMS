<?php

namespace Blog\service\serviceToExtend;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BothInterfacesAwareClass extends AwesomeServiceAwareClass implements EventDispatcherAwareInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * {@inheritdoc}
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return bool
     */
    public function hasEventDispatcherServiceSet()
    {
        return $this->eventDispatcher instanceof EventDispatcherInterface;
    }
}
