<?php

namespace ShopsUniverse\Mercury\Kernel;

class InMemoryEventStore implements EventStore
{
    private \ArrayObject $events;

    public function __construct()
    {
        $this->events = new \ArrayObject();
    }

    public function record(Event $event): void
    {
        $this->events->append($event);
    }

    public function publishAll(): \Iterator
    {
        foreach ($this->events as $event) {
            yield $event;
        }

        $this->events = new \ArrayObject();
    }
}
