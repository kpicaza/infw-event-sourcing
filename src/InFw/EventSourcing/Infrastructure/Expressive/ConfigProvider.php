<?php

namespace InFw\EventSourcing\Infrastructure\Expressive;

use InFw\EventSourcing\Emitter;
use InFw\TacticianAdapter\Factory\EmitterFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    Emitter::class => EmitterFactory::class,
                ],
            ],
            'events' => [
                    'listeners' => [
//                        Event::class => [
//                            Listener::class
//                        ]
                    ],
                    'projectors' => [
//                        Event::class => [
//                            Projector::class
//                        ]
                    ],
            ]
        ];
    }
}
