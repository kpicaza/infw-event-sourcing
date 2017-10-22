<?php

namespace InFw\EventSourcing;

use DateTime;

trait RecordEvents
{
    public function record(string $name, array $data)
    {
        Emitter::instance()->append(new Event(
            $name,
            new DateTime(),
            $data
        ));
    }
}
