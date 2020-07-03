<?php

namespace ShopsUniverse\Mercury\Tests\Kernel;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ShopsUniverse\Mercury\Kernel\Event;
use ShopsUniverse\Mercury\Kernel\EventStore;
use ShopsUniverse\Mercury\Kernel\InMemoryEventStore;

class InMemoryEventStoreTest extends TestCase
{
    /**
     * @test
     */
    public function shouldImplementEventStoreInterface()
    {
        $reflectionClass = new ReflectionClass(InMemoryEventStore::class);

        $this->assertTrue($reflectionClass->implementsInterface(EventStore::class));
    }

    /**
     * @test
     */
    public function shouldBeAbleToRecordEvent()
    {
        $eventStore = new InMemoryEventStore();

        $event = $this->createStub(Event::class);
        $eventStore->record($event);

        $reflectionObject = new \ReflectionObject($eventStore);

        /** @var \ReflectionProperty $eventsPropertyReflection */
        $eventsPropertyReflection = $reflectionObject->getProperty('events');
        $eventsPropertyReflection->setAccessible(true);

        $this->assertEquals(1, count($eventsPropertyReflection->getValue($eventStore)));
    }

    /**
     * @test
     */
    public function shouldPublishAllEvents()
    {
        $eventStore = new InMemoryEventStore();

        $event = $this->createStub(Event::class);
        $eventStore->record($event);

        $this->assertInstanceOf(\Iterator::class, $eventStore->publishAll());
    }

    /**
     * @test
     */
    public function eventStoreShouldBeEmptyAfterPublish()
    {
        $eventStore = new InMemoryEventStore();

        $event = $this->createStub(Event::class);
        $eventStore->record($event);
        $eventStore->record($event);

        foreach ($eventStore->publishAll() as $event) {
            $this->assertInstanceOf(Event::class, $event);
        }

        $reflectionObject = new \ReflectionObject($eventStore);

        /** @var \ReflectionProperty $eventsPropertyReflection */
        $eventsPropertyReflection = $reflectionObject->getProperty('events');
        $eventsPropertyReflection->setAccessible(true);

        $this->assertEquals(0, count($eventsPropertyReflection->getValue($eventStore)));
    }
}
