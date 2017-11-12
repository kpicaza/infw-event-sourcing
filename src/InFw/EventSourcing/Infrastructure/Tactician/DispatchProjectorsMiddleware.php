<?php

namespace InFw\EventSourcing\Infrastructure\Tactician;

use InFw\EventSourcing\EmitterInterface;
use League\Tactician\Middleware;

class DispatchProjectorsMiddleware implements Middleware
{
    /**
     * @param EmitterInterface $emitter
     */
    protected $emitter;

    /**
     * @param EmitterInterface $emitter
     */
    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $returnValue = $next($command);

        $this->emitter->publishProjectors();

        return $returnValue;
    }
}
