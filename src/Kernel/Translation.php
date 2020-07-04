<?php

namespace ShopsUniverse\Mercury\Kernel;

final class Translation
{
    private Locale $locale;
    private string $property;
    private string $value;

    public function __construct(
        Locale $locale,
        string $property,
        string $value
    ) {
        $this->locale = $locale;
        $this->property = $property;
        $this->value = $value;
    }

    public function getLocale(): Locale
    {
        return $this->locale;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
