<?php

namespace ShopsUniverse\Mercury\Kernel;

trait RecordableTrait
{
    protected EventStore $eventStore;

    public function setEventStore(EventStore $eventStore): void
    {
        $this->eventStore = $eventStore;
    }
}
