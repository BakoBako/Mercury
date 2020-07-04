<?php

namespace ShopsUniverse\Mercury\Kernel;

interface Recordable
{
    public function record(Event $event): void;
}
