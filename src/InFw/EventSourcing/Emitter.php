<?php

namespace InFw\EventSourcing;

/**
 * Class EventEmitter
 */
class Emitter extends BaseEmitter
{
    /**
     * @var array
     */
    protected $listeners = [];

    protected $events = [];

    /**
     * @var Emitter
     */
    private static $instance;

    protected function __construct()
    {
    }

    /**
     * @return Emitter
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
