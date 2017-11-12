<?php

namespace InFw\EventSourcing\Factory;

use InFw\EventSourcing\Emitter;
use Psr\Container\ContainerInterface;

class EmitterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $events = $container->get('config')['events'];

        $emitter = Emitter::instance();

        array_walk($events['listeners'], function ($listeners, $event) use ($container, $emitter) {
            array_walk($listeners, function ($listener) use ($container, $emitter, $event) {
                $emitter->addListener($event, $container->get($listener));
            });
        });
        array_walk($events['projectors'], function ($projectors, $event) use ($container, $emitter) {
            array_walk($projectors, function ($projector) use ($container, $emitter, $event) {
                $emitter->addProjector($event, $container->get($projector));
            });
        });

        return $emitter;
    }
}
