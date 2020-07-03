<?php

namespace ShopsUniverse\Mercury\Tests\Product\Events;

use PHPUnit\Framework\TestCase;
use ShopsUniverse\Mercury\Kernel\Event;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\ProductName;

class ProductRenamedTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeAEvent()
    {
        $reflectionClass = new \ReflectionClass(ProductRenamed::class);

        $this->assertTrue($reflectionClass->implementsInterface(Event::class));
    }

    /**
     * @test
     */
    public function shouldProvideProductChangedNameAndAlterer()
    {
        $event = new ProductRenamed(
            new Product('aProductName'),
            new ProductName('aChangedProductName'),
            new ProductName('aAltererProductName')
        );

        $this->assertEquals(new Product('aProductName'), $event->getProduct());
        $this->assertEquals(new ProductName('aChangedProductName'), $event->getChanged());
        $this->assertEquals(new ProductName('aAltererProductName'), $event->getAlterer());
    }
}
