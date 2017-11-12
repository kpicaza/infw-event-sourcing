<?php

namespace InFw\EventSourcing;

use League\Event\Emitter;
use League\Event\EventInterface;
use League\Event\ListenerAcceptorInterface;

class BaseEmitter extends Emitter implements EmitterInterface
{
    protected $events = [];
    protected $projectors = [];

    public function append(EventInterface $event)
    {
        $this->events[] = $event;
    }

    public function publish()
    {
        $this->emitBatch(
            $this->events
        );
    }

    public function publishProjectors()
    {
        $this->projectBatch(
            $this->events
        );
    }

    public function events()
    {
        return $this->events;
    }

    public function addProjector($event, callable $projector, $priority = ListenerAcceptorInterface::P_NORMAL)
    {
        $this->projectors[$event][$priority][] = $projector;
    }

    public function project(EventInterface $event)
    {
        list($name, $event) = $this->prepareEvent($event);
        $arguments = [$event] + func_get_args();
        $this->invokeProjectors($name, $event, $arguments);
        $this->invokeProjectors('*', $event, $arguments);

        return $event;
    }

    public function projectBatch(array $events)
    {
        $results = [];

        foreach ($events as $event) {
            $results[] = $this->project($event);
        }

        return $results;
    }

    protected function invokeProjectors($name, EventInterface $event, array $arguments)
    {
        $listeners = $this->getListeners($name);

        foreach ($listeners as $listener) {
            if ($event->isPropagationStopped()) {
                break;
            }

            call_user_func_array([$listener], $arguments);
        }
    }
}
