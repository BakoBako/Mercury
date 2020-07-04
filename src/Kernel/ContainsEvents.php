<?php

namespace ShopsUniverse\Mercury\Kernel;

interface ContainsEvents
{
    public function getRecordedEvents(): array;
    public function clearRecordedEvents(): void;
}
