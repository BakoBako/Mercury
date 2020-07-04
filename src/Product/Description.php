<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\ValueObject;

class Description implements ValueObject
{
    private string $description;

    public function __construct(string $description)
    {
        if (empty($description)) {
            throw new ArgumentNotBlankException('$description');
        }

        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}
