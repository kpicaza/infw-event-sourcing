<?php

namespace InFw\EventSourcing;

use DateTime;

trait RecordEvents
{
    protected function record(string $name, array $data)
    {
        Emitter::instance()->append(new Event(
            $name,
            new DateTime(),
            $data
        ));
    }
}
