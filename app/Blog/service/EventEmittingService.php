<?php

namespace Blog\Service;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventEmittingService
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function emit()
    {
        echo 'emitting first event';
        $this->eventDispatcher->dispatch(\Blog\event\Event::FIRST_EVENT);
    }
}
