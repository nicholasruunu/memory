<?php

namespace Memory\Events;

use InvalidArgumentException;

final class EventDispatcher
{
    private $eventMappings = array();

    public function addListener($event, $eventListener)
    {
        if (!is_callable($eventListener)) {
            throw new InvalidArgumentException(
                "The event listener is not defined as a callable"
            );
        }

        if (!isset($this->eventMappings[$event])) {
            $this->eventMappings[$event] = [];
        }

        $this->eventMappings[$event][] = $eventListener;
    }

    public function dispatchEvents(array $events)
    {
        foreach ($events as $event) {
            $this->dispatchEvent($event);
        }
    }

    public function dispatchEvent($event)
    {
        $eventClassName = get_class($event);

        if ( ! $this->hasEventListener($eventClassName)) {
            return;
        }

        foreach ($this->eventMappings[$eventClassName] as $listener) {
            $listener($event);
        }

    }

    private function hasEventListener($event)
    {
        return array_key_exists($event, $this->eventMappings);
    }
}
