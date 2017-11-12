<?php

namespace InFw\EventSourcing;

use League\Event\Emitter;
use League\Event\EventInterface;

class BaseEmitter extends Emitter implements EmitterInterface
{
    protected $events = [];

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

    public function events()
    {
        return $this->events;
    }
}
