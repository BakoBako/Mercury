<?php

namespace ShopsUniverse\Mercury\Kernel;

interface Recordable
{
    public function record(Event $event): void;
    public function getRecordedEvents(): array;
    public function clearRecordedEvents(): void;
}
