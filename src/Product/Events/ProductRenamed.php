<?php

namespace ShopsUniverse\Mercury\Product\Events;

use ShopsUniverse\Mercury\Kernel\Event;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\ProductName;

class ProductRenamed implements Event
{
    private Product $product;
    private ProductName $changed;
    private ProductName $alterer;

    public function __construct(
        Product $product,
        ProductName $changed,
        ProductName $alterer
    ) {
        $this->product = $product;
        $this->changed = $changed;
        $this->alterer = $alterer;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getChanged(): ProductName
    {
        return $this->changed;
    }

    public function getAlterer(): ProductName
    {
        return $this->alterer;
    }

    public function __toString(): string
    {
        return 'product.renamed';
    }
}
