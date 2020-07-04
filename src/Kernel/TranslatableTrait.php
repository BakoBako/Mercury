<?php

namespace ShopsUniverse\Mercury\Kernel;

trait TranslatableTrait
{
    protected array $translations = [];

    public function addTranslation(Translation $translation): void
    {
        $this->translations[] = $translation;
    }

    public function getTranslation(Locale $locale, string $property): ?Translation
    {
        /** @var Translation $translation */
        foreach ($this->translations as $translation) {
            if ($translation->getProperty() === $property && $translation->getLocale()->equals($locale)) {
                return $translation;
            }
        }

        return null;
    }

    public function findTranslation(?Locale $locale, string $property): ?string
    {
        if ($locale) {
            $translation = $this->getTranslation($locale, $property);

            if ($translation)
            {
                return $translation->getValue();
            }
        }

        return null;
    }
}
