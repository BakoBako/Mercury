<?php

namespace ShopsUniverse\Mercury\Tests\Product;

use ShopsUniverse\Mercury\Product\MetaInfo;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class MetaInfoTest extends ValueObjectCommonTests
{
    protected string $class = MetaInfo::class;
    protected array $arguments = ['aMetaTitle', 'aMetaKeywords', 'aMetaDescription'];
    protected string $toStringValue = 'aMetaTitle';

    /**
     * @test
     */
    public function shouldGiveMetaTitle()
    {
        $metaInfo = $this->metaInfoFixture();

        $this->assertEquals('aMetaTitle', $metaInfo->getTitle());
    }

    /**
     * @test
     */
    public function shouldGiveMetaKeywords()
    {
        $metaInfo = $this->metaInfoFixture();

        $this->assertEquals('aMetaKeywords', $metaInfo->getKeywords());
    }

    /**
     * @test
     */
    public function shouldGiveMetaDescription()
    {
        $metaInfo = $this->metaInfoFixture();

        $this->assertEquals('aMetaDescription', $metaInfo->getDescription());
    }

    private function metaInfoFixture(): MetaInfo
    {
        return new MetaInfo(
            'aMetaTitle',
            'aMetaKeywords',
            'aMetaDescription'
        );
    }
}
