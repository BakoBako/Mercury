<?php

namespace ShopsUniverse\Mercury\Kernel;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;

final class Locale implements ValueObject, ComparableValueObject
{
    private string $language;

    public function __construct(string $language)
    {
        if (empty($language)) {
            throw new ArgumentNotBlankException('$language');
        }

        $this->language = $language;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function equals(ValueObject $valueObject): bool
    {
        /** @noinspection PhpNonStrictObjectEqualityInspection */
        return $this == $valueObject;
    }

    public function __toString(): string
    {
        return $this->language;
    }
}
