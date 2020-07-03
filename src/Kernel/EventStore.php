<?php

namespace ShopsUniverse\Mercury\Kernel;

interface EventStore
{
    public function record(Event $event): void;
    public function publishAll(): \Iterator;
}
