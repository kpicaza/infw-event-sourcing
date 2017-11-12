<?php

namespace InFw\EventSourcing;

use League\Event\EventInterface;

interface EmitterInterface
{
    public function append(EventInterface $event);

    public function publish();

    public function events();
}
