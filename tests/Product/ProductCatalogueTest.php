<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use PHPUnit\Framework\TestCase;
use ShopsUniverse\Mercury\Catalogue\Catalogue;
use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\ProductCatalogue;

class ProductCatalogueTest extends TestCase
{
    /**
     * @test
     */
    public function shouldImplementCatalogueInterface()
    {
        $reflectionClass = new \ReflectionClass(ProductCatalogue::class);

        $this->assertTrue($reflectionClass->implementsInterface(Catalogue::class));
    }

    /**
     * @test
     */
    public function shouldBeAbleCreateCatalogueViaConstruct()
    {
        $catalogue = $this->catalogFixture();

        $this->assertInstanceOf(Catalogue::class, $catalogue);
    }

    /**
     * @test
     */
    public function shouldBeAbleToAddProductsInCatalogue()
    {
        $catalogue = $this->catalogFixture();

        $product = $this->createStub(Product::class);

        $catalogue->addItem($product);

        $this->assertIsArray($catalogue->items());
        $this->assertCount(1, $catalogue->items());
    }

    /**
     * @test
     */
    public function shouldGiveAllItemsInCatalogue()
    {
        $catalogue = $this->catalogFixture();

        $productOne = $this->createStub(Product::class);
        $productTwo = $this->createStub(Product::class);
        $productTwo->rename('aDifferentProductName');

        $catalogue->addItem($productOne);
        $catalogue->addItem($productTwo);

        $this->assertIsArray($catalogue->items());
        $this->assertCount(2, $catalogue->items());
        $this->assertInstanceOf(Product::class, $catalogue->items()[0]);
    }

    /**
     * @test
     */
    public function shouldGiveCatalogueCode()
    {
        $catalogue = $this->catalogFixture();

        $this->assertEquals('aCatalogueCode', $catalogue->getCode());
    }

    /**
     * @test
     */
    public function shouldGiveCatalogueName()
    {
        $catalogue = $this->catalogFixture();

        $this->assertEquals('aCatalogueName', $catalogue->getName());
    }

    /**
     * @test
     */
    public function shouldBeAbleToCheckIfItemExistsInCatalog()
    {
        $catalogue = $this->catalogFixture();

        $product = $this->createStub(Product::class);
        $productDifferent = $this->createStub(Product::class);
        $productDifferent->rename('aDifferentProductName');
        $productSame = $this->createStub(Product::class);

        $catalogue->addItem($product);

        $this->assertFalse($catalogue->hasItem($productDifferent));
        $this->assertTrue($catalogue->hasItem($productSame));
    }

    /**
     * @test
     */
    public function shouldSkipAddingItemIfAlreadyExistsInCatalogue()
    {
        $catalogue = $this->catalogFixture();

        $product = $this->createStub(Product::class);
        $productSame = $this->createStub(Product::class);

        $catalogue->addItem($product);
        $catalogue->addItem($productSame);

        $this->assertCount(1, $catalogue->items());
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenTryingToCreateCatalogWithInvalidCode()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $code cannot be blank');

        $catalogue = new ProductCatalogue(
            '',
            'aCatalogueName'
        );
    }

    private function catalogFixture(): Catalogue
    {
        return new ProductCatalogue(
            'aCatalogueCode',
            'aCatalogueName'
        );
    }
}
