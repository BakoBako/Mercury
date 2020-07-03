<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\ValueObject;

class ProductName implements ValueObject
{
    private string $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new ArgumentNotBlankException('$name');
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
