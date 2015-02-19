<?php

namespace Memory\Events\Aggregate;

use InvalidArgumentException;
use ReflectionClass;

trait AggregateRoot
{
    /**
     * @var array $events
     */
    private $events = array();

    /**
     * Builds object state from events
     *
     * @param array $events
     * @return Game
     */
    private static function buildFromHistory(array $events)
    {
        $object = new static();

        foreach ($events as $event) {
            $object->applyEvent($event, false);
        }

        $object->events[] = array();

        return $object;
    }

    /**
     * Applies event and adds it to history
     */
    private function applyEvent($event)
    {
        $eventName = (new ReflectionClass($event))->getShortName();
        $methodName = "apply{$eventName}";

        if (!is_callable([$this, $methodName]) || $methodName === __METHOD__) {
            throw new InvalidArgumentException(
                "There is no handler registered for {$eventName}"
            );
        }

        $this->{$methodName}($event);
        $this->events[] = $event;
    }

    /**
     * Flushes the array queue and returns the events
     *
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}
