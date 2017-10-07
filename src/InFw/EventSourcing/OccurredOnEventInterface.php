<?php

namespace InFw\EventSourcing;

use DateTimeInterface;

interface OccurredOnEventInterface
{
    public function occurredOn(): DateTimeInterface;
}
