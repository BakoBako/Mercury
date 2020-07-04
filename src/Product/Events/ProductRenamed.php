<?php

namespace ShopsUniverse\Mercury\Product\Events;

use ShopsUniverse\Mercury\Kernel\Event;
use ShopsUniverse\Mercury\Product\Product;
use ShopsUniverse\Mercury\Product\Name;

class ProductRenamed implements Event
{
    private Product $product;
    private Name $changed;
    private Name $alterer;

    public function __construct(
        Product $product,
        Name $changed,
        Name $alterer
    ) {
        $this->product = $product;
        $this->changed = $changed;
        $this->alterer = $alterer;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getChanged(): Name
    {
        return $this->changed;
    }

    public function getAlterer(): Name
    {
        return $this->alterer;
    }

    public function __toString(): string
    {
        return 'product.renamed';
    }
}
