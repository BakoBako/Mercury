<?php

namespace ShopsUniverse\Mercury\Kernel;

trait RecordableEntityTrait
{
    private array $events = [];

    public function getRecordedEvents(): array
    {
        return $this->events;
    }

    public function clearRecordedEvents(): void
    {
        $this->events = [];
    }

    public function record($message): void
    {
        $this->events[] = $message;
    }
}
