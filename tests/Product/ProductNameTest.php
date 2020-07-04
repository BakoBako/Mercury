<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\ValueObject;
use ShopsUniverse\Mercury\Product\Name;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class ProductNameTest extends ValueObjectCommonTests
{
    protected string $class = Name::class;
    protected array $arguments = ['aProductName'];
    protected string $toStringValue = 'aProductName';


    /**
     * @test
     */
    public function shouldThrowExceptionIfNameIsEmpty()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $name cannot be blank');

        $valueObject = new Name('');
    }
}
