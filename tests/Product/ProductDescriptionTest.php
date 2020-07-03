<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\ValueObject;
use ShopsUniverse\Mercury\Product\ProductDescription;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class ProductDescriptionTest extends ValueObjectCommonTests
{
    protected string $class = ProductDescription::class;
    protected array $arguments = ['aProductDescription'];
    protected string $toStringValue = 'aProductDescription';

    /**
     * @test
     */
    public function shouldThrowExceptionIfDescriptionIsEmpty()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $description cannot be blank');

        $valueObject = new ProductDescription('');
    }
}
