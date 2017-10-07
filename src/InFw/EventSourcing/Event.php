<?php

namespace InFw\EventSourcing;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use League\Event\Event as BaseEvent;

class Event extends BaseEvent implements OccurredOnEventInterface, DataEventInterface
{
    protected $occurredOn;

    protected $data;

    public function __construct(string $name, DateTimeInterface $occurredOn, $data)
    {
        parent::__construct($name);
        $this->occurredOn = $occurredOn;
        $this->data = $data;
    }

    public function occurredOn(): DateTimeInterface
    {
        return $this->occurredOn;
    }

    public function data()
    {
        return $this->data;
    }
}
