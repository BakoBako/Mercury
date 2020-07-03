<?php

namespace ShopsUniverse\Mercury\Tests\Kernel;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\ValueObject;
use ShopsUniverse\Mercury\Kernel\EntityCode;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class EntityCodeTest extends ValueObjectCommonTests
{
    protected string $class = EntityCode::class;
    protected array $arguments = ['aCode'];
    protected string $toStringValue = 'aCode';

    /**
     * @test
     */
    public function shouldThrowExceptionIfCodeIsEmpty()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $code cannot be blank');

        $valueObject = new EntityCode('');
    }
}
