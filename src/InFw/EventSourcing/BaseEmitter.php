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
        $this->invokeProjectors($name, $event);
        $this->invokeProjectors('*', $event);

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

    protected function invokeProjectors($name, EventInterface $event)
    {
        $projectors = $this->projectors[$name];
        if ($event->isPropagationStopped()) {
            return;
        }

        array_walk($projectors,  function (array $orderedProjectors) use ($event) {
            array_walk($orderedProjectors , function (callable $projector) use ($event) {
                call_user_func($projector, $event);
            });
        });
    }
}
