<?php

namespace InFw\TacticianAdapter\Factory;

use InFw\EventSourcing\Emitter;
use Psr\Container\ContainerInterface;

class EmitterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $events = $container->get('config')['events'];

        $emitter = Emitter::instance();

        array_walk($events['listeners'], function ($listener, $event) use ($container, $emitter) {
            $emitter->addListener($event, $container->get($listener));
        });
        array_walk($events['projectors'], function ($projector, $event) use ($container, $emitter) {
            $emitter->addProjector($event, $container->get($projector));
        });

        return $emitter;
    }
}
