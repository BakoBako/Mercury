<?php

namespace ShopsUniverse\Mercury\Kernel;

interface Recordable
{
    public function setEventStore(EventStore $eventStore): void;
}
