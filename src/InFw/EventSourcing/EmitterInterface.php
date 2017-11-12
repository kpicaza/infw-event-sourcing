<?php

namespace InFw\EventSourcing;

use League\Event\EventInterface;
use League\Event\EmitterInterface as BaseEmitterInterface;
use League\Event\ListenerAcceptorInterface;

interface EmitterInterface extends BaseEmitterInterface
{
    public function append(EventInterface $event);

    public function addProjector($event, callable $projector, $priority = ListenerAcceptorInterface::P_NORMAL);

    public function publish();

    public function project(EventInterface $event);

    public function projectBatch(array $events);

    public function publishProjectors();

    public function events();
}
