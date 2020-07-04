<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Product\Description;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class DescriptionTest extends ValueObjectCommonTests
{
    protected string $class = Description::class;
    protected array $arguments = ['aProductDescription'];
    protected string $toStringValue = 'aProductDescription';

    /**
     * @test
     */
    public function shouldThrowExceptionIfDescriptionIsEmpty()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $description cannot be blank');

        $valueObject = new Description('');
    }
}
