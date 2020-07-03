<?php

namespace ShopsUniverse\Mercury\Tests;

use PHPUnit\Framework\TestCase;
use ShopsUniverse\Mercury\Kernel\ValueObject;

class ValueObjectCommonTests extends TestCase
{
    protected string $class;
    protected array $arguments = [];
    protected string $toStringValue = '';

    /**
     * @test
     */
    public function shouldCreateObjectViaConstructor()
    {
        /** @var ValueObject $valueObject */
        $valueObject = new $this->class(...$this->arguments);

        $this->assertEquals($this->toStringValue, $valueObject);
    }

    /**
     * @test
     */
    public function shouldBeAValueObject()
    {
        $reflectionClass = new \ReflectionClass($this->class);

        $this->assertTrue($reflectionClass->implementsInterface(ValueObject::class));
    }
}
