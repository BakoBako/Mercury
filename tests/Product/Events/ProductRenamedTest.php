<?php

namespace ShopsUniverse\Mercury\Tests\Product\Events;

use PHPUnit\Framework\TestCase;
use ShopsUniverse\Mercury\Kernel\Event;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;
use ShopsUniverse\Mercury\Product\MetaInfo;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\Name;

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
            $this->productFixture(),
            new Name('aChangedProductName'),
            new Name('aAltererProductName')
        );

        $this->assertEquals($this->productFixture(), $event->getProduct());
        $this->assertEquals(new Name('aChangedProductName'), $event->getChanged());
        $this->assertEquals(new Name('aAltererProductName'), $event->getAlterer());
    }

    /**
     * @test
     */
    public function shouldGiveEventCodeNameIfTreatedAsString()
    {
        $event = new ProductRenamed(
            $this->productFixture(),
            new Name('aChangedProductName'),
            new Name('aAltererProductName')
        );

        $this->assertEquals('product.renamed', $event);
    }

    private function productFixture(): Product
    {
        return new Product(
            'aProductId',
            'aProductCode',
            'aProductName',
            'aProductDescription',
            new MetaInfo(
                'aProductMetaTitle',
                'aProductMetaKeywords',
                'aProductMetaDescription'
            )
        );
    }
}
