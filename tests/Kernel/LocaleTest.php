<?php

namespace ShopsUniverse\Mercury\Tests\Kernel;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\ComparableValueObject;
use ShopsUniverse\Mercury\Kernel\Locale;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class LocaleTest extends ValueObjectCommonTests
{
    protected string $class = Locale::class;
    protected array $arguments = ['aLanguage'];
    protected string $toStringValue = 'aLanguage';

    /**
     * @test
     */
    public function shouldBeComparable()
    {
        $reflectionClass = new \ReflectionClass(Locale::class);

        $this->assertTrue($reflectionClass->implementsInterface(ComparableValueObject::class));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfLanguageIsEmpty()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $language cannot be blank');

        $valueObject = new Locale('');
    }

    /**
     * @test
     */
    public function shouldGiveTheLanguage()
    {
        $locale = new Locale('EN');

        $this->assertEquals('EN', $locale->getLanguage());
    }

    /**
     * @test
     */
    public function shouldBeAbleToCompareWithOtherLocale()
    {
        $locale = new Locale('EN');

        $this->assertTrue($locale->equals(new Locale('EN')));
        $this->assertFalse($locale->equals(new Locale('ES')));
    }
}
