<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use PHPUnit\Framework\TestCase;
use ShopsUniverse\Mercury\Kernel\InMemoryEventStore;
use ShopsUniverse\Mercury\Kernel\Recordable;
use ShopsUniverse\Mercury\Kernel\TranslatableInterface;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\ProductInterface;
use ShopsUniverse\Mercury\Product\ProductName;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function shouldImplementProductInterface()
    {
        $reflectionClass = new \ReflectionClass(Product::class);

        $this->assertTrue($reflectionClass->implementsInterface(ProductInterface::class));
    }

    /**
     * @test
     */
    public function shouldSupportTranslations()
    {
        $reflectionClass = new \ReflectionClass(Product::class);

        $this->assertTrue($reflectionClass->implementsInterface(TranslatableInterface::class));
    }

    /**
     * @test
     */
    public function shouldSupportRecordingOfEvents()
    {
        $reflectionClass = new \ReflectionClass(Product::class);

        $this->assertTrue($reflectionClass->implementsInterface(Recordable::class));
    }

    /**
     * @test
     */
    public function shouldGiveTheProductName()
    {
        $product = new Product('aProductName');

        $this->assertInstanceOf(ProductName::class, $product->getName());
        $this->assertEquals('aProductName', $product->getName());
    }

    /**
     * @test
     */
    public function shouldBeAbleToRenameTheProduct()
    {
        $product = new Product('aProductName');
        $product->setEventStore(new InMemoryEventStore());

        $this->assertEquals('aProductName', $product->getName());

        $product->rename('aDifferentProductName');

        $this->assertInstanceOf(ProductName::class, $product->getName());
        $this->assertEquals('aDifferentProductName', $product->getName());
    }

    /**
     * @test
     */
    public function shouldRecordRenamingOfAProduct()
    {
        $product = new Product('aProductName');
        $eventStore = new InMemoryEventStore();
        $product->setEventStore($eventStore);
        $product->rename('aDifferentProductName');

        /** @var ProductRenamed $event */
        foreach ($eventStore->publishAll() as $event) {
            $this->assertInstanceOf(ProductRenamed::class, $event);
            $this->assertEquals($product, $event->getProduct());
            $this->assertEquals(new ProductName('aProductName'), $event->getChanged());
            $this->assertEquals(new ProductName('aDifferentProductName'), $event->getAlterer());
        }
    }
}
