<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 7/10/17
 * Time: 17:38
 */

namespace InFw\EventSourcing;

use League\Event\Emitter;
use League\Event\EventInterface;

class BaseEmitter extends Emitter
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

}
