<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Kernel\Entity;
use ShopsUniverse\Mercury\Kernel\Code;
use ShopsUniverse\Mercury\Kernel\Locale;

interface ProductInterface extends Entity
{
    public function getName(Locale $locale = null): Name;
    public function rename(string $name): void;

    public function getDescription(Locale $locale = null) : Description;
}
