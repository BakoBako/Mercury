<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Kernel\EntityCode;

interface ProductInterface
{
    public function getName(): ProductName;
    public function rename(string $name): void;

    public function getDescription() : ProductDescription;
    public function getCode() : EntityCode;
}
