<?php

namespace ShopsUniverse\Mercury\Kernel;

interface Translatable
{
    public function addTranslation(Translation $translation): void;

    public function getTranslation(Locale $locale, string $property): ?Translation;

    public function findTranslation(?Locale $locale, string $property): ?string;
}
