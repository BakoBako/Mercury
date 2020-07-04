<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use PHPUnit\Framework\TestCase;
use ShopsUniverse\Mercury\Catalogue\Catalogable;
use ShopsUniverse\Mercury\Kernel\ComparableEntity;
use ShopsUniverse\Mercury\Kernel\Entity;
use ShopsUniverse\Mercury\Kernel\Code;
use ShopsUniverse\Mercury\Kernel\Locale;
use ShopsUniverse\Mercury\Kernel\Recordable;
use ShopsUniverse\Mercury\Kernel\Translatable;
use ShopsUniverse\Mercury\Kernel\Translation;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;
use ShopsUniverse\Mercury\Product\MetaInfo;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\Description;
use ShopsUniverse\Mercury\Product\ProductInterface;
use ShopsUniverse\Mercury\Product\Name;

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

        $this->assertTrue($reflectionClass->implementsInterface(Translatable::class));
    }

    /**
     * @test
     */
    public function shouldBeEntity()
    {
        $reflectionClass = new \ReflectionClass(Product::class);

        $this->assertTrue($reflectionClass->implementsInterface(Entity::class));
    }

    /**
     * @test
     */
    public function shouldSupportComparison()
    {
        $reflectionClass = new \ReflectionClass(Product::class);

        $this->assertTrue($reflectionClass->implementsInterface(ComparableEntity::class));
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
    public function canBeOrganizedIntoCatalogue()
    {
        $reflectionClass = new \ReflectionClass(Product::class);

        $this->assertTrue($reflectionClass->implementsInterface(Catalogable::class));
    }

    /**
     * @test
     */
    public function shouldGiveTheProductName()
    {
        $product = $this->productFixture();

        $this->assertInstanceOf(Name::class, $product->getName());
        $this->assertEquals('aProductName', $product->getName());
    }

    /**
     * @test
     */
    public function shouldGiveProductNameTranslation()
    {
        $product = $this->productFixture();
        $locale = new Locale('ES');
        $product->addTranslation(
            new Translation(
                $locale,
                'name',
                'unNombreDeProducto'
            )
        );

        $this->assertInstanceOf(Name::class, $product->getName());
        $this->assertEquals('unNombreDeProducto', $product->getName($locale));
    }

    /**
     * @test
     */
    public function shouldReturnNullIfTransactionIsNotFound()
    {
        $product = $this->productFixture();

        $this->assertNull(
            $product->findTranslation(
                new Locale('GB'),
                'name'
            )
        );
    }

    /**
     * @test
     */
    public function shouldBeAbleToRenameTheProduct()
    {
        $product = $this->productFixture();

        $this->assertEquals('aProductName', $product->getName());

        $product->rename('aDifferentProductName');

        $this->assertInstanceOf(Name::class, $product->getName());
        $this->assertEquals('aDifferentProductName', $product->getName());
    }

    /**
     * @test
     */
    public function shouldRecordRenamingOfAProduct()
    {
        $product = $this->productFixture();
        $product->rename('aDifferentProductName');

        /** @var ProductRenamed $event */
        foreach ($product->getRecordedEvents() as $event) {
            $this->assertInstanceOf(ProductRenamed::class, $event);
            $this->assertEquals($product, $event->getProduct());
            $this->assertEquals(new Name('aProductName'), $event->getChanged());
            $this->assertEquals(new Name('aDifferentProductName'), $event->getAlterer());
        }
    }

    /**
     * @test
     */
    public function shouldGiveTheProductDescription()
    {
        $product = $this->productFixture();

        $this->assertInstanceOf(Description::class, $product->getDescription());
        $this->assertEquals('aProductDescription', $product->getDescription());
    }

    /**
     * @test
     */
    public function shouldGiveProductDescriptionTranslation()
    {
        $product = $this->productFixture();
        $locale = new Locale('ES');
        $product->addTranslation(
            new Translation(
                $locale,
                'description',
                'unaDescripciónDelProducto'
            )
        );

        $this->assertInstanceOf(Description::class, $product->getDescription());
        $this->assertEquals('unaDescripciónDelProducto', $product->getDescription($locale));
    }

    /**
     * @test
     */
    public function shouldGiveTheProductCode()
    {
        $product = $this->productFixture();

        $this->assertInstanceOf(Code::class, $product->getCode());
        $this->assertEquals('aProductCode', $product->getCode());
    }

    /**
     * @test
     */
    public function shouldGiveTheProductId()
    {
        $product = $this->productFixture();

        $this->assertEquals('aProductId', $product->getId());
    }

    /**
     * @test
     */
    public function shouldBeAbleToClearRecordedEvents()
    {
        $product = $this->productFixture();
        $product->rename('aDifferentProductName');

        $product->clearRecordedEvents();

        $this->assertEmpty($product->getRecordedEvents());
    }

    /**
     * @test
     */
    public function shouldGiveProductMetaInfo()
    {
        $product = $this->productFixture();

        $this->assertInstanceOf(MetaInfo::class, $product->getMetaInfo());

        $this->assertEquals('aProductMetaTitle', $product->getMetaInfo()->getTitle());
        $this->assertEquals('aProductMetaKeywords', $product->getMetaInfo()->getKeywords());
        $this->assertEquals('aProductMetaDescription', $product->getMetaInfo()->getDescription());
    }

    /**
     * @test
     */
    public function shouldBeAbleToCompareWithOtherProducts()
    {
        $product = $this->productFixture();

        $this->assertTrue(
            $product->equals(
                new Product(
                    'aProductId',
                    'aProductCode',
                    'aProductName',
                    'aProductDescription',
                    new MetaInfo(
                        'aProductMetaTitle',
                        'aProductMetaKeywords',
                        'aProductMetaDescription'
                    )
                )
            )
        );

        $this->assertFalse(
            $product->equals(
                new Product(
                    'aProductId',
                    'aProductCodeNotEqual',
                    'aProductName',
                    'aProductDescription',
                    new MetaInfo(
                        'aProductMetaTitle',
                        'aProductMetaKeywords',
                        'aProductMetaDescription'
                    )
                )
            )
        );
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
